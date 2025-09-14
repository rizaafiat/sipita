<?php
$thisPage = "Data Pemohon Informasi";
session_start();
include 'header.php';
?>

<title><?php echo htmlspecialchars($thisPage); ?></title>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h1 class="display-5 mb-3">
                <i class="fa fa-user fa-fw"></i>
                <?php echo htmlspecialchars($thisPage); ?>
            </h1>
        </div>
    </div>

<?php
if (!isset($connection)) {
    die('<div class="alert alert-danger">Koneksi database gagal. Pastikan config.php sudah benar.</div>');
}

try {
    // Ambil pemohon unik berdasarkan nama & nik
    $stmt = $connection->query("SELECT nama, nik, email, alamat, pekerjaan, instansi FROM permohonan_informasi GROUP BY nama, nik");
    $pemohonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('<div class="alert alert-danger">Query gagal: '.htmlspecialchars($e->getMessage()).'</div>');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pemohonTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>Instansi</th>
                                    <th>Daftar Nomor Permohonan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pemohonList)): $no=1; foreach($pemohonList as $pemohon): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($pemohon['nama']); ?></td>
                                    <td>
                                        <?php
                                        $nik = $pemohon['nik'];
                                        if (strlen($nik) > 4) {
                                            // Tampilkan 8 digit depan, sisanya *
                                            $show = substr($nik, 0, 8);
                                            $mask = str_repeat('*', strlen($nik) - 8);
                                            echo htmlspecialchars($show . $mask);
                                        } else {
                                            echo htmlspecialchars($nik);
                                        }
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($pemohon['email']); ?></td>
                                    <td><?= htmlspecialchars($pemohon['alamat']); ?></td>
                                    <td><?= htmlspecialchars($pemohon['pekerjaan']); ?></td>
                                    <td><?= htmlspecialchars($pemohon['instansi']); ?></td>
                                    <td>
                                        <?php
                                        // Query semua nomor tiket milik pemohon ini
                                        $stmtTiket = $connection->prepare("SELECT nomor_tiket FROM permohonan_informasi WHERE nama = :nama AND nik = :nik ORDER BY id DESC");
                                        $stmtTiket->execute([
                                            ':nama' => $pemohon['nama'],
                                            ':nik' => $pemohon['nik']
                                        ]);
                                        $tiketList = $stmtTiket->fetchAll(PDO::FETCH_COLUMN);
                                        if ($tiketList) {
                                            echo '<ul class="mb-0">';
                                            foreach ($tiketList as $tiket) {
                                                echo '<li>' . htmlspecialchars($tiket) . '</li>';
                                            }
                                            echo '</ul>';
                                        } else {
                                            echo '<em>Tidak ada permohonan</em>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="6" class="text-center">Belum ada data pemohon.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    // DataTables
    $('#pemohonTable').DataTable({
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
        }
    });
});
</script>

<?php include 'footer.php'; ?>