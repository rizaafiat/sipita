<?php
session_start();
include 'config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php?pesan=invalid_request");
    exit();
}

// Validate input
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    header("Location: login.php?pesan=empty_fields");
    exit();
}

// Use prepared statement to prevent SQL injection (PDO)
$stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row || !password_verify($password, $row['password'])) {
    header("Location: login.php?pesan=gagal");
    exit();
}

// Set session variables
$_SESSION['uname'] = $row['username'];
$_SESSION['nama'] = $row['nama_user'];
$_SESSION['role'] = $row['role'];
$_SESSION['last_activity'] = time(); // waktu login/aktivitas terakhir

// Redirect ke dashboard setelah login sukses
header("Location: dashboard.php");
exit();