<?php
// File: cek_status.php

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai session
session_start();

// Include koneksi database
require 'koneksi_db.php';

// Fungsi untuk membersihkan input
function bersihkanInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Proses form cek status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['old_input'] = $_POST;
    
    try {
        // Validasi input
        $nomor_tiket = bersihkanInput($_POST['nomor_tiket'] ?? '');
        $telepon = bersihkanInput($_POST['telepon'] ?? '');
        
        if (empty($nomor_tiket) || empty($telepon)) {
            throw new Exception("Nomor tiket dan telepon harus diisi");
        }
        
        // Query ke database
        $stmt = $conn->prepare("SELECT 
                nomor_tiket, nama, tanggal_permohonan, 
                status_proses, rincian_data, alasan_permohonan, keterangan_proses, dokumen_proses
            FROM permohonan_informasi 
            WHERE nomor_tiket = :tiket AND telepon = :telepon
            LIMIT 1");
            
        $stmt->execute([
            ':tiket' => $nomor_tiket,
            ':telepon' => $telepon
        ]);
        
        $permohonan = $stmt->fetch();
        
        if ($permohonan) {
            // Simpan data di session untuk ditampilkan
            $_SESSION['result'] = $permohonan;
            header("Location: cek_status_permohonan.php?success=1");
            exit();
        } else {
            throw new Exception("Data tidak ditemukan. Periksa kembali nomor tiket dan telepon.");
        }
        
    } catch (PDOException $e) {
        error_log(date('[Y-m-d H:i:s]') . " DB Error: " . $e->getMessage() . "\n", 3, "error.log");
        $_SESSION['error'] = "Terjadi kesalahan sistem. Silakan coba lagi nanti.";
        header("Location: cek_status_permohonan.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: cek_status_permohonan.php");
        exit();
    }
}

// Tampilkan halaman
require 'header.php';
require 'form_cek_status_permohonan.php';

if (isset($_GET['success']) && isset($_SESSION['result'])) {
    require 'tampil_hasil_cek_status_permohonan.php';
    unset($_SESSION['result']);
}

require 'footer.php';
?>