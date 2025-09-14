<?php
// File: grafik_permohonan.php
session_start();
require 'koneksi_db.php';
require 'header.php';

// Query jumlah total permohonan
$total = $conn->query("SELECT COUNT(*) FROM permohonan_informasi")->fetchColumn();

// Query jumlah permohonan per bulan (tahun berjalan)
$bulanData = $conn->query("
    SELECT MONTH(tanggal_permohonan) as bulan, COUNT(*) as jumlah
    FROM permohonan_informasi
    WHERE YEAR(tanggal_permohonan) = YEAR(CURDATE())
    GROUP BY bulan
    ORDER BY bulan
")->fetchAll(PDO::FETCH_ASSOC);

// Query jumlah permohonan per tahun (5 tahun terakhir)
$tahunData = $conn->query("
    SELECT YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah
    FROM permohonan_informasi
    GROUP BY tahun
    ORDER BY tahun DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

// Siapkan data bulan
$bulanLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
$bulanJumlah = array_fill(0, 12, 0);
foreach ($bulanData as $row) {
    $bulanIndex = (int)$row['bulan'] - 1;
    $bulanJumlah[$bulanIndex] = (int)$row['jumlah'];
}

// Siapkan data tahun
$tahunLabels = [];
$tahunJumlah = [];
foreach (array_reverse($tahunData) as $row) {
    $tahunLabels[] = $row['tahun'];
    $tahunJumlah[] = (int)$row['jumlah'];
}

// Query status permohonan untuk pie chart
$statusPie = $conn->query("SELECT status_proses, COUNT(*) as jumlah FROM permohonan_informasi GROUP BY status_proses")->fetchAll(PDO::FETCH_ASSOC);
// Siapkan data status untuk JS
$statusPieData = [];
foreach ($statusPie as $row) {
    $statusPieData[] = [
        'name' => $row['status_proses'] ?: 'Tidak Diketahui',
        'y' => (int)$row['jumlah']
    ];
}
?>

<!-- Highcharts CDN -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="container my-5">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="text-center mb-4"><i class="fa-solid fa-chart-column me-2"></i> Statistik Permohonan Informasi per Bulan</h4>
      <div id="permohonanChart" style="height:420px;"></div>
    </div>

      <div class="card-body">
        <h4 class="text-center mb-4"><i class="fa-solid fa-chart-pie me-2"></i> Statistik berdasarkan Status Permohonan</h4>
        <div id="statusPieChart" style="height:380px;"></div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data PHP ke JS
    const totalPermohonan = Number(<?php echo json_encode($total); ?>) || 0;
    const bulanLabels = <?php echo json_encode($bulanLabels); ?> || [];
    const bulanJumlah = <?php echo json_encode($bulanJumlah); ?> || [];
    const tahunLabels = <?php echo json_encode($tahunLabels); ?> || [];
    const tahunJumlah = <?php echo json_encode($tahunJumlah); ?> || [];
    const statusPieData = <?php echo json_encode($statusPieData); ?> || [];

    // Gabungkan kategori: hanya Bulan (tanpa Total)
    const categories = bulanLabels;
    // Data untuk seri per bulan
    const dataBulan = bulanJumlah;

    Highcharts.chart('permohonanChart', {
        chart: { type: 'column' },
        title: { text: '' },
        xAxis: {
            categories: categories,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: { text: 'Jumlah Permohonan' }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' permohonan'
        },
        legend: { align: 'center', verticalAlign: 'top' },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                borderRadius: 6
            }
        },
        series: [
            {
                name: 'Per Bulan',
                data: dataBulan,
                color: '#06b6d4'
            }
        ]
    });

    // Pie Chart Status Permohonan
    Highcharts.chart('statusPieChart', {
        chart: { type: 'pie' },
        title: { text: '' },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
        },
        accessibility: {
            point: { valueSuffix: '%' }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
                }
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: statusPieData.length ? statusPieData : [{name:'Tidak ada data', y:1, color:'#ccc', dataLabels:{enabled:false}}]
        }]
    });
});
</script>

<?php require 'footer.php'; ?>