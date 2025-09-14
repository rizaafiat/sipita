<?php
// Tampilkan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
require_once 'koneksi_db.php'; // File untuk koneksi database

// Pastikan folder uploads ada
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    if (!mkdir($target_dir, 0755, true)) {
        die("Gagal membuat folder uploads");
    }
}

// Generate nomor tiket
$nomor_tiket = 'PPID-' . date('Ymd') . '-' . substr(md5(uniqid()), 0, 6);

// Siapkan variabel email user
$email_user = isset($_POST['email']) ? $_POST['email'] : '';

// Proses upload file
$target_file = '';
if (
    !isset($_FILES["dokumen_surat_permohonan"]) ||
    $_FILES["dokumen_surat_permohonan"]["error"] === UPLOAD_ERR_NO_FILE
) {
    die("File surat permohonan wajib diunggah.");
}

// Tangani error upload
$fileError = $_FILES["dokumen_surat_permohonan"]["error"];
switch ($fileError) {
    case UPLOAD_ERR_OK:
        // lanjut
        break;
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
        die("Ukuran file terlalu besar. Maksimal 4MB.");
    case UPLOAD_ERR_PARTIAL:
        die("File hanya terupload sebagian.");
    default:
        die("Terjadi error upload file. Kode: $fileError");
}

// Cek ukuran file (jika lolos error di atas, tetap cek manual)
if ($_FILES["dokumen_surat_permohonan"]["size"] > 4 * 1024 * 1024) {
    die("Ukuran file maksimal 4MB.");
}

$fileName = basename($_FILES["dokumen_surat_permohonan"]["name"]);
$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
if (!in_array($fileType, $allowed)) {
    die("Hanya file PDF, JPG, JPEG, PNG yang diperbolehkan.");
}

// Rename file agar unik
$newFileName = 'dokumen_permohonan_' . time() . '_' . rand(1000,9999) . '.' . $fileType;
$target_file = $target_dir . $newFileName;

if (!move_uploaded_file($_FILES["dokumen_surat_permohonan"]["tmp_name"], $target_file)) {
    die("Gagal mengupload file.");
}

// Proses data checkbox
$cara_memperoleh = isset($_POST['cara_memperoleh']) ? implode(", ", (array)$_POST['cara_memperoleh']) : '';
$cara_salinan = isset($_POST['cara_salinan']) ? implode(", ", (array)$_POST['cara_salinan']) : '';

// Siapkan query SQL
$sql = "INSERT INTO permohonan_informasi (
    nama, nik, status_permohonan, email, telepon, alamat, pekerjaan, instansi,
    rincian_data, alasan_permohonan, tujuan_penggunaan, cara_memperoleh, cara_salinan,
    dokumen_surat_permohonan, nomor_tiket, status_proses
) VALUES (
    :nama, :nik, :status_permohonan, :email, :telepon, :alamat, :pekerjaan, :instansi,
    :rincian_data, :alasan_permohonan, :tujuan_penggunaan, :cara_memperoleh, :cara_salinan,
    :dokumen_surat_permohonan, :nomor_tiket, 'Submit'
)";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nama', $_POST['nama']);
    $stmt->bindValue(':nik', $_POST['nik']);
    $stmt->bindValue(':status_permohonan', $_POST['status_permohonan']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':telepon', $_POST['telepon']);
    $stmt->bindValue(':alamat', $_POST['alamat']);
    $stmt->bindValue(':pekerjaan', $_POST['pekerjaan']);
    $stmt->bindValue(':instansi', $_POST['instansi']);
    $stmt->bindValue(':rincian_data', $_POST['rincian_data']);
    $stmt->bindValue(':alasan_permohonan', $_POST['alasan_permohonan']);
    $stmt->bindValue(':tujuan_penggunaan', $_POST['tujuan_penggunaan']);
    $stmt->bindValue(':cara_memperoleh', $cara_memperoleh);
    $stmt->bindValue(':cara_salinan', $cara_salinan);
    $stmt->bindValue(':dokumen_surat_permohonan', $target_file);
    $stmt->bindValue(':nomor_tiket', $nomor_tiket);
    $stmt->execute();

    // Kirim email notifikasi ke user dengan PHPMailer SMTP
    if (filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        require_once __DIR__ . '/src/PHPMailer.php';
        require_once __DIR__ . '/src/SMTP.php';
        require_once __DIR__ . '/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            // Konfigurasi SMTP hosting Anda
            $mail->isSMTP();
            $mail->Host       = 'imola.id.domainesia.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'admin@bkkbnkalsel.online';
            $mail->Password   = 'Datindatindatin';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Pengirim & Penerima (USER)
            $mail->setFrom('admin@bkkbnkalsel.online', 'SIPITA');
            $mail->addAddress($email_user, $_POST['nama']);

            // Konten email untuk USER
            $mail->isHTML(true);
            $mail->Subject = 'Permohonan Informasi Anda Telah Diterima';
            $mail->Body    = "Yth. {$_POST['nama']}, <br>Permohonan informasi Anda telah diterima.<br><br>
                            <b>Nomor Tiket:</b> $nomor_tiket<br>
                            <b>Status:</b> Sudah Submit Permohonan<br><br>
                            Silakan simpan nomor tiket ini untuk pengecekan status permohonan Anda di <a href='https://sipita.bkkbnkalsel.online/cek_status_permohonan.php'>https://sipita.bkkbnkalsel.online/cek_status_permohonan.php</a><br><br>
                            Terima kasih.";

            $mail->send();

            // Kirim email ke ADMIN dengan subject & body berbeda
            $mailAdmin = new PHPMailer\PHPMailer\PHPMailer(true);
            $mailAdmin->isSMTP();
            $mailAdmin->Host       = 'imola.id.domainesia.com';
            $mailAdmin->SMTPAuth   = true;
            $mailAdmin->Username   = 'admin@bkkbnkalsel.online';
            $mailAdmin->Password   = 'Datindatindatin';
            $mailAdmin->SMTPSecure = 'ssl';
            $mailAdmin->Port       = 465;

            $mailAdmin->setFrom('admin@bkkbnkalsel.online', 'SIPITA');
            $mailAdmin->addAddress('admin@bkkbnkalsel.online', 'Admin SIPITA');

            $mailAdmin->isHTML(false);
            $mailAdmin->Subject = 'Permohonan Baru Masuk dari ' . $_POST['nama'];
            $mailAdmin->Body    = "Ada permohonan informasi baru:\n"
                . "Nama: {$_POST['nama']}\n"
                . "Email: {$_POST['email']}\n"
                . "Nomor Tiket: $nomor_tiket\n\n"
                . "Silakan cek Dashboard SIPITA untuk detail permohonan.";

            $mailAdmin->send();

        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
    // Redirect ke halaman sukses
    header("Location: form_permohonan_informasi_sukses.php?tiket=" . urlencode($nomor_tiket));
    exit();

} catch(PDOException $e) {
    die("Error database: " . $e->getMessage());
}
?>