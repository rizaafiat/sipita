<?php
$host = '103.147.154.179';
$dbname = 'bkkbnkal_sipita';
$username = 'bkkbnkal_admin';
$password = '@Datin123!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode yang benar (gunakan ERRMODE_EXCEPTION atau ERRMODE_WARNING)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Set timezone
    $conn->exec("SET time_zone = '+08:00'");
    
    // Tambahkan opsi penting lainnya
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
} catch(PDOException $e) {
    // Simpan error ke log file
    $error_msg = date('[Y-m-d H:i:s]') . " Koneksi DB Gagal: " . $e->getMessage() . "\n";
    file_put_contents(__DIR__ . '/error.log', $error_msg, FILE_APPEND);
    
    // Tampilkan halaman error yang profesional
    showErrorPage();
}

function showErrorPage() {
    http_response_code(503); // Service Unavailable
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistem Sedang Dalam Pemeliharaan</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Lato', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #1d71b8 35%, #89cfe8 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #333;
            }
            
            .error-container {
                background: white;
                border-radius: 20px;
                padding: 40px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 700px;
                width: 90%;
                animation: fadeIn 0.8s ease-out;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .error-icon {
                width: 80px;
                height: 80px;
                background: #ff6b6b;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
            
            .error-icon svg {
                width: 40px;
                height: 40px;
                fill: white;
            }
            
            .error-title {
                font-size: 28px;
                font-weight: bold;
                margin-bottom: 15px;
                color: #2c3e50;
            }
            
            .error-message {
                font-size: 16px;
                line-height: 1.6;
                margin-bottom: 30px;
                color: #7f8c8d;
            }
            
            .error-details {
                background: #f8f9fa;
                border-left: 4px solid #007bff;
                padding: 15px;
                margin-bottom: 30px;
                border-radius: 5px;
                text-align: left;
            }
            
            .error-details h4 {
                margin-bottom: 10px;
                color: #007bff;
            }
            
            .error-details ul {
                margin-left: 20px;
                color: #6c757d;
            }
            
            .error-details li {
                margin-bottom: 5px;
            }
            
            .contact-info {
                background: #e8f5e8;
                border-radius: 10px;
                padding: 20px;
                margin-top: 20px;
            }
            
            .contact-info h4 {
                color: #28a745;
                margin-bottom: 10px;
            }
            
            .contact-info p {
                color: #155724;
                margin-bottom: 5px;
            }
            
            .refresh-btn {
                background: linear-gradient(45deg, #007bff, #0056b3);
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 25px;
                font-size: 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 20px;
            }
            
            .refresh-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            }
            
            .timestamp {
                font-size: 12px;
                color: #adb5bd;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            
            <h1 class="error-title">Sistem Sedang Dalam Pemeliharaan</h1>
            
            <p class="error-message">
                Maaf, SIPITA sedang mengalami gangguan teknis. 
                Tim teknis kami sedang bekerja untuk memperbaiki masalah ini.
            </p>
            
            <div class="error-details">
                <h4>Apa yang dapat Anda lakukan?</h4>
                <ul>
                    <li>Coba refresh halaman dalam beberapa menit</li>
                    <li>Periksa koneksi internet Anda</li>
                    <li>Hubungi administrator sistem jika masalah berlanjut</li>
                </ul>
            </div>
            
            <div class="contact-info">
                <h4>Informasi Kontak</h4>
                <p><strong>Email:</strong> adminppid@bkkbnkalsel.online</p>
                <p><strong>Telepon:</strong> 087814500033</p>
                <p><strong>Jam Kerja:</strong> Senin - Jumat, 08:00 - 17:00 WIB</p>
            </div>
            
            <button class="refresh-btn" onclick="window.location.reload()">
                Coba Lagi
            </button>
            
            <div class="timestamp">
                Waktu kejadian: <?php 
                    date_default_timezone_set('Asia/Makassar');
                    echo date('d/m/Y H:i:s'); 
                ?> WITA
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>