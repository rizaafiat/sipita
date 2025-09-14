<?php 
session_start();
include 'config.php';
include 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/logo.png">
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
    <!-- Plugin & custom CSS -->
    <link href="vendor/bootstrap/css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="vendor/customcss/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/select2/dist/css/select2.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables core -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.3.2/r-3.0.5/datatables.min.css" rel="stylesheet" integrity="sha384-0I/FNUD0w+p/9JmXAmDh/m0wNCsPw29Ww+OWemk7cYTO9K0Dh8fFV+apdE/GnrlN" crossorigin="anonymous">
 
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.2/r-3.0.5/datatables.min.js" integrity="sha384-hSDrs7R2Cek0fpYq/3wboj2jKKkanuIXT1b+i4n7k3SQdujZjmJ2fSsO8P2dj8LN" crossorigin="anonymous"></script>
        <!-- Plugin JS -->
    <script src="vendor/jQueryUI/jquery-ui.js"></script> 
    <script src="vendor/bootstrap/js/bootstrapValidator.min.js"></script>
    <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="vendor/customcss/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="vendor/select2/dist/js/select2.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 0">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php"><span class="fa fa-terminal"></span> Panel Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Selamat Datang, <?php echo $_SESSION['uname']?> <span class="fa fa-user"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="user_profil.php"><span class="fa fa-user"></span> Profil</a></li>
                                <li><a class="dropdown-item" href="user_ganti_pass.php"><span class="fa fa-lock"></span> Ganti Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="user_logout.php"><span class="fa fa-sign-out"></span> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex">
            <nav class="bg-light sidebar" style="min-width:220px;">
                <div class="sidebar-sticky pt-3">
                    <div class="thumbnail mb-3 border-0">
                        <img class="img-fluid" src="../img/logo_dashboard.png" alt="Logo">
                    </div>
                    <ul class="nav flex-column" id="side-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="permohonan_informasi.php"><i class="fa fa-file-text fa-fw"></i> Data Permohonan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_pemohon.php"><i class="fa fa-user fa-fw"></i> Data Pemohon</a>
                        </li>
                        <?php if ($_SESSION['role'] !== 'user'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php"><i class="fa fa-users fa-fw"></i> Data User</a>
                        </li>
                        <?php endif; ?>
                        <!-- Tambahkan menu lain di sini -->
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="flex-grow-1 p-3">