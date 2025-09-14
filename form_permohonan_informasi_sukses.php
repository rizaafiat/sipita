<?php
if (!isset($_GET['tiket'])) {
    header("Location: formulir-permohonan-informasi.html");
    exit();
}

$nomor_tiket = htmlspecialchars($_GET['tiket']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Berhasil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h2><i class="fas fa-check-circle"></i> Permohonan Berhasil Dikirim</h2>
            </div>
            <div class="card-body">
                <p>Permohonan Anda telah berhasil dikirim dan akan diproses dalam 4 hari kerja.</p>
                <p>Silakan simpan nomor tiket berikut untuk melacak status permohonan Anda:</p>
                <div class="alert alert-info">
                    <h4 class="text-center"><?= $nomor_tiket ?></h4>
                </div>
                <a href="permohonan_informasi.php" class="btn btn-primary">Kembali ke Formulir</a>
            </div>
        </div>
    </div>
</body>
</html>