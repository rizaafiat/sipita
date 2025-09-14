<?php 
$thisPage = "Dashboard";
include 'header.php';
?>

<title><?php echo htmlspecialchars($thisPage); ?></title>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h1 class="display-5 mb-3">
                <i class="fa-solid fa-gauge"></i>
                <?php echo htmlspecialchars($thisPage); ?>
            </h1>
        </div>
    </div>

<?php 
if (!isset($connection) || !($connection instanceof PDO)) {
    die("Database connection error");
}

// Function to safely get count from database
if (!function_exists('getCount')) {
    function getCount($connection, $table) {
        $stmt = $connection->prepare("SELECT COUNT(*) FROM $table");
        if (!$stmt) {
            die("Prepare failed");
        }
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
}

$jum_permohonan = getCount($connection, 'permohonan_informasi');
$jum_user = getCount($connection, 'users');
$jum_pemohon = $connection->query("SELECT COUNT(*) FROM (SELECT nama, nik FROM permohonan_informasi GROUP BY nama, nik) AS pemohon_unik")->fetchColumn();
$total = $connection->query("SELECT COUNT(*) FROM permohonan_informasi")->fetchColumn();
$jum_submit = $connection->query("SELECT COUNT(*) FROM permohonan_informasi WHERE status_proses = 'Submit'")->fetchColumn();
$jum_selesai = $connection->query("SELECT COUNT(*) FROM permohonan_informasi WHERE status_proses = 'Selesai'")->fetchColumn();

$bulanData = $connection->query("
    SELECT MONTH(tanggal_permohonan) as bulan, COUNT(*) as jumlah
    FROM permohonan_informasi
    WHERE YEAR(tanggal_permohonan) = YEAR(CURDATE())
    GROUP BY bulan
    ORDER BY bulan
")->fetchAll();

$tahunData = $connection->query("
    SELECT YEAR(tanggal_permohonan) as tahun, COUNT(*) as jumlah
    FROM permohonan_informasi
    GROUP BY tahun
    ORDER BY tahun DESC
    LIMIT 5
")->fetchAll();

$bulanLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
$bulanJumlah = array_fill(0, 12, 0);
foreach ($bulanData as $row) {
    $bulanIndex = (int)$row['bulan'] - 1;
    $bulanJumlah[$bulanIndex] = (int)$row['jumlah'];
}

$tahunLabels = [];
$tahunJumlah = [];
foreach (array_reverse($tahunData) as $row) {
    $tahunLabels[] = $row['tahun'];
    $tahunJumlah[] = (int)$row['jumlah'];
}
?>

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">
        <div class="card border-primary shadow h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fa-solid fa-file-lines fa-3x text-primary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?php echo $jum_permohonan; ?></div>
                    <div>Permohonan</div>
                </div>
            </div>
            <a href="permohonan_informasi.php" class="card-footer text-decoration-none d-flex justify-content-between align-items-center small">
                <span>Selengkapnya...</span>
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

        <div class="col-lg-3 col-md-6">
        <div class="card border-secondary shadow h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fa-solid fa-file-lines fa-3x text-secondary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?php echo $jum_submit; ?></div>
                    <div>Permohonan Baru</div>
                </div>
            </div>
            <a href="permohonan_informasi.php" class="card-footer text-decoration-none d-flex justify-content-between align-items-center small">
                <span>Selengkapnya...</span>
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

        <div class="col-lg-3 col-md-6">
        <div class="card border-warning shadow h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fa-solid fa-file-lines fa-3x text-warning"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?php echo $jum_selesai; ?></div>
                    <div>Permohonan Selesai</div>
                </div>
            </div>
            <a href="permohonan_informasi.php" class="card-footer text-decoration-none d-flex justify-content-between align-items-center small">
                <span>Selengkapnya...</span>
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-success shadow h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fa-solid fa-user fa-3x text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?php echo $jum_pemohon; ?></div>
                    <div>Data Pemohon</div>
                </div>
            </div>
            <a href="data_pemohon.php" class="card-footer text-decoration-none d-flex justify-content-between align-items-center small">
                <span>Selengkapnya...</span>
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

<?php if ($_SESSION['role'] !== 'user'): ?>
<!--         <div class="col-lg-3 col-md-6">
        <div class="card border-danger shadow h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fa-solid fa-users fa-3x text-danger"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold"><?php echo $jum_user; ?></div>
                    <div>Data User</div>
                </div>
            </div>
            <a href="user.php" class="card-footer text-decoration-none d-flex justify-content-between align-items-center small">
                <span>Selengkapnya...</span>
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> > -->
<?php endif; ?> 
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-white">
                <i class="fa fa-chart-bar"></i> Grafik Permohonan Per Bulan
            </div>
            <div class="card-body">
                <div id="permohonanChart" style="width:100%;height:400px;"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalPermohonan = Number(<?php echo json_encode($total); ?>) || 0;
    const bulanLabels = <?php echo json_encode($bulanLabels); ?> || [];
    const bulanJumlah = <?php echo json_encode($bulanJumlah); ?> || [];
    const tahunLabels = <?php echo json_encode($tahunLabels); ?> || [];
    const tahunJumlah = <?php echo json_encode($tahunJumlah); ?> || [];

    Highcharts.chart('permohonanChart', {
        chart: { type: 'column' },
        title: { text: '' },
        xAxis: {
            categories: bulanLabels,
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
                data: bulanJumlah,
                color: '#06b6d4'
            }
        ]
    });
});
</script>

<?php 
include 'footer.php';
?>