<?php
session_start();
$timeout = 1800; // 1800 detik = 30 menit

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Session expired
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time(); // update waktu aktivitas terakhir

if(!isset($_SESSION['uname'])){
    header("location:login.php");
    exit();
}
?>