<?php
// ajax_user.php
session_start();
include 'config.php';
header('Content-Type: text/html; charset=utf-8');

if (!isset($connection)) {
    die('<div class="alert alert-danger">Koneksi database gagal.</div>');
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// Tambah User
if ($action == 'add') {
    $nama = trim($_POST['nama_user'] ?? '');
    $alamat = trim($_POST['alamat_user'] ?? '');
    $jkel = trim($_POST['jkel_user'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = trim($_POST['role'] ?? '');
    if ($nama && $alamat && $jkel && $username && $password && $role) {
        // Cek username unik
        $cek = $connection->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $cek->execute([$username]);
        if ($cek->fetchColumn() > 0) {
            echo '<div class="alert alert-danger">Username sudah digunakan.</div>';
            exit;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (nama_user, alamat_user, jkel_user, username, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$nama, $alamat, $jkel, $username, $hash, $role])) {
            echo '<div class="alert alert-success">User berhasil ditambahkan.</div>';
        } else {
            echo '<div class="alert alert-danger">Gagal menambah user.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Semua field wajib diisi.</div>';
    }
    exit;
}

// View User
if ($action == 'view') {
    $id = $_GET['id'] ?? '';
    $stmt = $connection->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        echo '<table class="table table-bordered">';
        echo '<tr><th>ID User</th><td>'.htmlspecialchars($row['id_user']).'</td></tr>';
        echo '<tr><th>Nama</th><td>'.htmlspecialchars($row['nama_user']).'</td></tr>';
        echo '<tr><th>Alamat</th><td>'.htmlspecialchars($row['alamat_user']).'</td></tr>';
        echo '<tr><th>Jenis Kelamin</th><td>'.htmlspecialchars($row['jkel_user']).'</td></tr>';
        echo '<tr><th>Username</th><td>'.htmlspecialchars($row['username']).'</td></tr>';
        echo '<tr><th>Role</th><td>'.htmlspecialchars($row['role']).'</td></tr>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-danger">User tidak ditemukan.</div>';
    }
    exit;
}

// Edit User (form)
if ($action == 'edit') {
    $id = $_GET['id'] ?? '';
    $stmt = $connection->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        ?>
        <form id="editUserForm">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($row['id_user']); ?>">
            <div class="form-group"><label>Nama</label><input type="text" name="nama_user" class="form-control" value="<?php echo htmlspecialchars($row['nama_user']); ?>" required></div>
            <div class="form-group"><label>Alamat</label><input type="text" name="alamat_user" class="form-control" value="<?php echo htmlspecialchars($row['alamat_user']); ?>" required></div>
            <div class="form-group"><label>Jenis Kelamin</label><select name="jkel_user" class="form-control"><option value="L" <?php if($row['jkel_user']=='L') echo 'selected'; ?>>Laki-laki</option><option value="P" <?php if($row['jkel_user']=='P') echo 'selected'; ?>>Perempuan</option></select></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" required></div>
            <div class="form-group"><label>Password (isi jika ingin ganti)</label><input type="password" name="password" class="form-control"></div>
            <div class="form-group"><label>Role</label><input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($row['role']); ?>" required></div>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-danger">User tidak ditemukan.</div>';
    }
    exit;
}

// Update User
if ($action == 'update') {
    $id = $_POST['id_user'] ?? '';
    $nama = trim($_POST['nama_user'] ?? '');
    $alamat = trim($_POST['alamat_user'] ?? '');
    $jkel = trim($_POST['jkel_user'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = trim($_POST['role'] ?? '');
    if ($nama && $alamat && $jkel && $username) {
        // Cek username unik (kecuali user ini sendiri)
        $cek = $connection->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND id_user != ?");
        $cek->execute([$username, $id]);
        if ($cek->fetchColumn() > 0) {
            echo '<div class="alert alert-danger">Username sudah digunakan.</div>';
            exit;
        }
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("UPDATE users SET nama_user=?, alamat_user=?, jkel_user=?, username=?, password=?, role=? WHERE id_user=?");
            $ok = $stmt->execute([$nama, $alamat, $jkel, $username, $hash, $role, $id]);
        } else {
            $stmt = $connection->prepare("UPDATE users SET nama_user=?, alamat_user=?, jkel_user=?, username=?, role=? WHERE id_user=?");
            $ok = $stmt->execute([$nama, $alamat, $jkel, $username, $role, $id]);
        }
        if ($ok) {
            echo '<div class="alert alert-success">User berhasil diupdate.</div>';
        } else {
            echo '<div class="alert alert-danger">Gagal update user.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Semua field wajib diisi.</div>';
    }
    exit;
}

// Delete User
if ($action == 'delete') {
    $id = $_POST['id'] ?? '';
    $stmt = $connection->prepare("DELETE FROM users WHERE id_user = ?");
    if ($stmt->execute([$id])) {
        echo '<div class="alert alert-success">User berhasil dihapus.</div>';
    } else {
        echo '<div class="alert alert-danger">Gagal menghapus user.</div>';
    }
    exit;
}

echo '<div class="alert alert-danger">Aksi tidak valid.</div>';
