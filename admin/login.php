<?php
// login.php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e5091 0%, #2563eb 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(30,80,145,0.18);
            padding: 36px 32px 28px 32px;
            max-width: 370px;
            width: 100%;
        }
        .login-card .form-label {
            font-weight: 600;
            color: #1e5091;
        }
        .login-card .btn-primary {
            background: #1e5091;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 0;
            width: 100%;
            transition: background 0.2s;
        }
        .login-card .btn-primary:hover {
            background: #2563eb;
        }
        .login-card .form-control {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            font-size: 1rem;
        }
        .login-card .alert {
            border-radius: 8px;
            font-size: 0.98rem;
        }
        .login-title {
            text-align: center;
            color: #1e5091;
            font-weight: 700;
            margin-bottom: 18px;
            font-size: 1.7rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-title">Login</div>
        <?php if ($pesan == 'gagal'): ?>
            <div class="alert alert-danger">Username atau password salah!</div>
        <?php elseif ($pesan == 'empty_fields'): ?>
            <div class="alert alert-warning">Username dan password wajib diisi!</div>
        <?php elseif ($pesan == 'invalid_request'): ?>
            <div class="alert alert-danger">Akses tidak valid.</div>
        <?php endif; ?>
        <form action="login_proses.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="Masukkan username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>