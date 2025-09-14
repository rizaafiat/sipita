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
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"/>
    <!-- jQuery (wajib sebelum Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <!-- Plugin JS -->
    <script src="vendor/jQueryUI/jquery-ui.js"></script> 
    <script src="vendor/bootstrap/js/bootstrapValidator.min.js"></script>
    <script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="vendor/customcss/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="vendor/select2/dist/js/select2.min.js"></script>
    <style>
        #sidebar {
            transition: left 0.2s;
            min-width: 220px;
            max-width: 80vw;
            background: #f8f9fa;
        }
        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                z-index: 1040;
                height: 100vh;
                top: 0;
                left: -220px;
                box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            }
            #sidebar.show {
                left: 0;
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                z-index: 1039;
                top: 0; left: 0; width: 100vw; height: 100vh;
                background: rgba(0,0,0,0.3);
            }
            .sidebar-backdrop.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 0">
            <div class="container-fluid">
                <!-- Sidebar Toggle Button (only on mobile) -->
                <button class="btn btn-outline-secondary me-2 d-lg-none" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
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
            <!-- Sidebar -->
            <nav class="bg-light sidebar" id="sidebar">
                <div class="sidebar-sticky pt-3 text-center">
                    <img class="img-fluid mb-2" src="../img/logo_dashboard.png" alt="Logo">
                    <div class="fw-bold small mb-3">
                        Kemendukbangga/BKKBN<br>
                        Perwakilan BKKBN Provinsi<br>
                        Kalimantan Selatan
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
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'user'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php"><i class="fa fa-users fa-fw"></i> Data User</a>
                        </li>
                        <?php endif; ?>
                        <!-- Tambahkan menu lain di sini -->
                    </ul>
                </div>
            </nav>
            <div class="sidebar-backdrop d-lg-none"></div>
            <div id="page-wrapper" class="flex-grow-1 p-3">