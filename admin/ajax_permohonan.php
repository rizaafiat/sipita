<?php
// ajax_permohonan.php
include 'config.php';

// PHPMailer
require_once __DIR__ . '/../src/PHPMailer.php';
require_once __DIR__ . '/../src/SMTP.php';
require_once __DIR__ . '/../src/Exception.php';
$mailer_config = require __DIR__ . '/../src/config_mailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$admin_email = 'admin@bkkbnkalsel.online'; // Ganti dengan email admin Anda
$survey_link_base = 'https://tally.so/r/npO4gb'; // Ganti dengan URL survey Anda
$cek_status_permohonan = 'https://sipita.bkkbnkalsel.online/cek_status_permohonan.php';

if (!isset($_POST['action']) && isset($_GET['action'])) {
    $_POST['action'] = $_GET['action'];
    $_POST['id'] = $_GET['id'] ?? null;
}
$action = $_POST['action'] ?? '';
$id = intval($_POST['id'] ?? 0);

if ($action === 'view' && $id) {
    $stmt = $connection->prepare("SELECT * FROM permohonan_informasi WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered mb-0">';
        echo '<tbody>';
        echo '<tr><th>Nomor Tiket</th><td>'.htmlspecialchars($row['nomor_tiket']).'</td></tr>';
        echo '<tr><th>Nama</th><td>'.htmlspecialchars($row['nama']).'</td></tr>';
        echo '<tr><th>NIK</th><td>'.htmlspecialchars($row['nik']).'</td></tr>';
        echo '<tr><th>Status Permohonan</th><td>'.htmlspecialchars($row['status_permohonan']).'</td></tr>';
        echo '<tr><th>Email</th><td>'.htmlspecialchars($row['email']).'</td></tr>';
        echo '<tr><th>Telepon</th><td>'.htmlspecialchars($row['telepon']).'</td></tr>';
        echo '<tr><th>Alamat</th><td>'.htmlspecialchars($row['alamat']).'</td></tr>';
        echo '<tr><th>Pekerjaan</th><td>'.htmlspecialchars($row['pekerjaan']).'</td></tr>';
        echo '<tr><th>Instansi</th><td>'.htmlspecialchars($row['instansi']).'</td></tr>';
        echo '<tr><th>Rincian Data</th><td>'.htmlspecialchars($row['rincian_data']).'</td></tr>';
        echo '<tr><th>Alasan Permohonan</th><td>'.htmlspecialchars($row['alasan_permohonan']).'</td></tr>';
        echo '<tr><th>Tujuan Penggunaan</th><td>'.htmlspecialchars($row['tujuan_penggunaan']).'</td></tr>';
        echo '<tr><th>Cara Memperoleh</th><td>'.htmlspecialchars($row['cara_memperoleh']).'</td></tr>';
        echo '<tr><th>Cara Salinan</th><td>'.htmlspecialchars($row['cara_salinan']).'</td></tr>';
        // Tombol download dokumen surat permohonan
        if (!empty($row['dokumen_surat_permohonan'])) {
            $fileUrl = '../uploads/' . basename($row['dokumen_surat_permohonan']);
            echo '<tr><th>Dokumen Surat Permohonan</th><td>
                <a href="' . $fileUrl . '" class="btn btn-primary btn-sm" download>
                    <i class="fa fa-download"></i> Download
                </a>
            </td></tr>';
        } else {
            echo '<tr><th>Dokumen Surat Permohonan</th><td><span class="text-muted">Belum ada file</span></td></tr>';
        }
        echo '<tr><th>Status</th><td>'.htmlspecialchars($row['status_proses']).'</td></tr>';
        echo '<tr><th>Keterangan Balasan</th><td>'.htmlspecialchars($row['keterangan_proses']).'</td></tr>';
        if (!empty($row['dokumen_proses'])) {
            $fileUrl = '../uploads/balasan/' . basename($row['dokumen_proses']);
            echo '<tr><th>Dokumen Balasan</th><td>
                <a href="' . $fileUrl . '" class="btn btn-primary btn-sm" download>
                    <i class="fa fa-download"></i> Download
                </a>
            </td></tr>';
        } else {
            echo '<tr><th>Dokumen Balasan</th><td><span class="text-muted">Belum ada file</span></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        // Timeline status
        $stmtLog = $connection->prepare("SELECT * FROM permohonan_status_log WHERE permohonan_id=? ORDER BY tanggal ASC");
        $stmtLog->execute([$id]);
        $logs = $stmtLog->fetchAll();
        echo '<hr><h5>Timeline Status</h5>';
        if ($logs && count($logs) > 0) {
            echo '<ul style="list-style: none; padding-left: 0;">';
            foreach($logs as $log) {
                echo '<li style="margin-bottom:10px;">';
                echo '<span style="font-weight:bold;">'.htmlspecialchars($log['status']).'</span> ';
                echo '<span class="text-muted" style="font-size:90%;">('.date('d-m-Y H:i', strtotime($log['tanggal'])).')</span><br>';
                if ($log['keterangan']) {
                    echo '<span style="font-size:90%;">'.nl2br(htmlspecialchars($log['keterangan'])).'</span>';
                }
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<div class="text-muted">Belum ada riwayat status.</div>';
        }

    } else {
        echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
    }
    exit;
}

if ($action === 'edit' && $id) {
    $stmt = $connection->prepare("SELECT * FROM permohonan_informasi WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        echo '<form id="editForm">';
        echo '<input type="hidden" name="id" value="'.intval($row['id']).'">';
        echo '<div class="form-group"><label>Nomor Tiket</label><input type="text" name="nomor_tiket" class="form-control" value="'.htmlspecialchars($row['nomor_tiket']).'" readonly></div>';
        echo '<div class="form-group"><label>Status</label><select name="status_proses" class="form-control">';
        $statusArr = ['Submit','Proses Sepenuhnya','Proses Sebagian','Selesai (Sepenuhnya)','Selesai (Sebagian)','Ditolak (Dikecualikan)','Ditolak (Tidak Dikuasai)','Ditolak (Bukan Kewenangan)'];
        foreach($statusArr as $s) {
            $selected = ($row['status_proses']==$s)?'selected':'';
            echo "<option value='$s' $selected>$s</option>";
        }
        echo '</select></div>';
        // Field Keterangan
        echo '<div class="form-group mb-2"><label>Keterangan Balasan</label>';
        echo '<textarea name="keterangan_proses" class="form-control" rows="4">'.htmlspecialchars($row['keterangan_proses'] ?? '').'</textarea></div>';

        // Field Upload Dokumen
        echo '<div class="form-group mb-2"><label>Upload Dokumen Balasan</label>';
        echo '<input type="file" name="dokumen_surat_permohonan" class="form-control">';
        if (!empty($row['dokumen_proses'])) {
            $fileUrl = '../uploads/balasan/' . basename($row['dokumen_proses']);
            echo '<div class="mt-1"><a href="'.$fileUrl.'" target="_blank" class="btn btn-link btn-sm"><i class="fa fa-download"></i> Download Dokumen</a></div>';
        }
        echo '</div>';
        echo '</form>';
    } else {
        echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
    }
    exit;
}

if ($action === 'update' && $id) {
    $status = $_POST['status_proses'] ?? '';
    $keterangan_proses = $_POST['keterangan_proses'] ?? '';

    // Ambil data lama untuk file jika tidak upload baru + data email/nama
    $stmt = $connection->prepare("SELECT * FROM permohonan_informasi WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    $dokumen_proses = $row['dokumen_proses'] ?? '';
    $email_pemohon = $row['email'] ?? '';
    $nama_pemohon = $row['nama'] ?? '';
    $nomor_tiket = $row['nomor_tiket'] ?? '';

    // Proses upload file jika ada file baru
    if (isset($_FILES['dokumen_surat_permohonan']) && $_FILES['dokumen_surat_permohonan']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['dokumen_surat_permohonan']['tmp_name'];
        $name = basename($_FILES['dokumen_surat_permohonan']['name']);
        $target_dir = __DIR__ . '/../uploads/balasan/';
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $new_name = 'balasan_' . time() . '_' . uniqid() . '_' . $name;
        $target_file = $target_dir . $new_name;
        if (move_uploaded_file($tmp_name, $target_file)) {
            $dokumen_proses = $new_name;
        }
    }

    try {
        $stmt = $connection->prepare("UPDATE permohonan_informasi SET status_proses=?, keterangan_proses=?, dokumen_proses=? WHERE id=?");
        $update = $stmt->execute([$status, $keterangan_proses, $dokumen_proses, $id]);
        if ($update) {

            // INSERT LOG STATUS
            $stmtLog = $connection->prepare("INSERT INTO permohonan_status_log (permohonan_id, status, keterangan) VALUES (?, ?, ?)");
            $stmtLog->execute([$id, $status, $keterangan_proses]);

            // Kirim email ke pemohon dan admin dengan PHPMailer
            $subject = "Status Permohonan Informasi #$nomor_tiket";
            $survey_link = $survey_link_base . "?ticket=" . urlencode($nomor_tiket);
            $message = "Yth. $nama_pemohon,<br><br>
                Status permohonan informasi Anda dengan nomor tiket <b>$nomor_tiket</b> telah berubah menjadi: <b>$status</b>.<br>
                Keterangan: $keterangan_proses<br><br>";

            if ($status === 'Selesai (Sepenuhnya)' || $status === 'Selesai (Sebagian)') {
                $message .= "
                Silahkan cek status detailnya di <a href='$cek_status_permohonan'>$cek_status_permohonan</a><br><br>
                Mohon kesediaan Anda untuk mengisi survei kepuasan pelayanan kami melalui link berikut:<br>
                <a href='$survey_link'>$survey_link</a><br><br>";
            }

            $message .= "Terima kasih.<br>Team SIPITA BKKBN Kalimantan Selatan";

            // Konfigurasi PHPMailer
            $mail = new PHPMailer(true);
            try {
                // SMTP config (ganti sesuai server Anda)
                $mail->isSMTP();
                $mail->Host       = $mailer_config['host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $mailer_config['username'];
                $mail->Password   = $mailer_config['password'];
                $mail->SMTPSecure = $mailer_config['secure'];
                $mail->Port       = $mailer_config['port'];
                $mail->setFrom($mailer_config['from'], $mailer_config['from_name']);
                if (filter_var($email_pemohon, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($email_pemohon, $nama_pemohon);
                }
                $mail->addAddress($admin_email, 'Admin SIPITA');

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo '<div class="alert alert-success">Data berhasil diupdate & email notifikasi telah dikirim.</div>';
            } catch (Exception $e) {
                echo '<div class="alert alert-warning">Data berhasil diupdate, namun email gagal dikirim. Error: ' . htmlspecialchars($mail->ErrorInfo) . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Gagal update data.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Gagal update data: '.htmlspecialchars($e->getMessage()).'</div>';
    }
    exit;
}

if ($action === 'add') {
    // Nomor tiket otomatis
    $nomor_tiket = 'PPID-' . date('Ymd') . '-' . substr(md5(uniqid()), 0, 6);
    $nama = $_POST['nama'] ?? '';
    $tanggal = $_POST['tanggal_permohonan'] ?? '';
    $status = $_POST['status_proses'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $rincian = $_POST['rincian_data'] ?? '';
    $alasan = $_POST['alasan_permohonan'] ?? '';
    try {
        $stmt = $connection->prepare("INSERT INTO permohonan_informasi (nomor_tiket, nama, tanggal_permohonan, status_proses, telepon, rincian_data, alasan_permohonan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert = $stmt->execute([$nomor_tiket, $nama, $tanggal, $status, $telepon, $rincian, $alasan]);
        if ($insert) {
            echo '<div class="alert alert-success">Data berhasil ditambahkan.<br>Nomor Tiket: <b>'.$nomor_tiket.'</b></div>';
        } else {
            echo '<div class="alert alert-danger">Gagal menambah data.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Gagal menambah data: '.htmlspecialchars($e->getMessage()).'</div>';
    }
    exit;
}

if ($action === 'delete' && $id) {
    try {
        $stmt = $connection->prepare("DELETE FROM permohonan_informasi WHERE id = ?");
        $delete = $stmt->execute([$id]);
        if ($delete) {
            echo '<div class="alert alert-success">Data berhasil dihapus.</div>';
        } else {
            echo '<div class="alert alert-danger">Gagal menghapus data.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Gagal menghapus data: '.htmlspecialchars($e->getMessage()).'</div>';
    }
    exit;
}

echo '<div class="alert alert-danger">Permintaan tidak valid.</div>';