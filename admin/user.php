<?php
$thisPage = "Manajemen User";
session_start();
include 'header.php';

if (!isset($connection)) {
    die('<div class="alert alert-danger">Koneksi database gagal. Pastikan config.php sudah benar.</div>');
}
try {
    $stmt = $connection->query("SELECT * FROM users ORDER BY id_user DESC");
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die('<div class="alert alert-danger">Query gagal: '.htmlspecialchars($e->getMessage()).'</div>');
}
?>

<title><?php echo htmlspecialchars($thisPage); ?></title>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h1 class="display-5 mb-3">
                <i class="fa fa-users fa-fw"></i>
                <?php echo htmlspecialchars($thisPage); ?>
            </h1>
        </div>
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'petugas'): ?>
                        <button class="btn btn-success btn-sm float-end" id="addUserBtn"><i class="fa fa-plus"></i> Tambah Baru</button>
                    <?php endif; ?>                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID User</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>JK</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $no=1; 
                                if ($users && count($users) > 0):
                                    foreach($users as $row): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($row['id_user']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_user']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat_user']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jkel_user']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['level_user']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tipe_user']); ?></td>
                                    <td>
                                        <button class="btn btn-info btn-xs view-user" data-id="<?php echo $row['id_user']; ?>"><i class="fa fa-eye"></i></button>
                                        <?php if ($_SESSION['role'] === 'admin'): ?>
                                            <button class="btn btn-warning btn-xs edit-user" data-id="<?php echo $row['id_user']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs delete-user" data-id="<?php echo $row['id_user']; ?>"><i class="fa fa-trash"></i></button>
                                        <?php elseif ($_SESSION['role'] === 'petugas'): ?>
                                            <!-- Petugas tidak bisa edit/delete user -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; 
                                else:
                                    echo '<tr><td colspan="9" class="text-center">Tidak ada data user.</td></tr>';
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal User Bootstrap 5 -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="userModalLabel"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="userModalBody">
        <!-- Konten dinamis -->
      </div>
      <div class="modal-footer" id="userModalFooter">
        <!-- Tombol dinamis -->
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    // Tambah User
    $('#addUserBtn').on('click', function(){
        $('#userModalLabel').text('Tambah User Baru');
        var formHtml = '<form id="addUserForm">'+
            '<div class="form-group mb-2"><label>Nama</label><input type="text" name="nama_user" class="form-control" required></div>'+
            '<div class="form-group mb-2"><label>Alamat</label><input type="text" name="alamat_user" class="form-control" required></div>'+
            '<div class="form-group mb-2"><label>Jenis Kelamin</label><select name="jkel_user" class="form-control"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>'+
            '<div class="form-group mb-2"><label>Username</label><input type="text" name="username" class="form-control" required></div>'+
            '<div class="form-group mb-2"><label>Password</label><input type="password" name="password" class="form-control" required></div>'+
            '<div class="form-group mb-2"><label>Role</label><input type="text" name="role" class="form-control" required></div>'+
            '</form>';
        $('#userModalBody').html(formHtml);
        $('#userModalFooter').html('<button type="submit" form="addUserForm" class="btn btn-success">Simpan</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
        $('#userModal').modal('show');
    });
    // Submit Tambah
    $(document).on('submit', '#addUserForm', function(e){
        e.preventDefault();
        $.post('ajax_user.php', $(this).serialize()+'&action=add', function(res){
            $('#userModalBody').html(res);
            $('#userModalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        });
    });
    // View
    $(document).on('click', '.view-user', function(){
        var id = $(this).data('id');
        $.get('ajax_user.php', {action:'view', id:id}, function(res){
            $('#userModalLabel').text('Detail User');
            $('#userModalBody').html(res);
            $('#userModalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            $('#userModal').modal('show');
        });
    });
    // Edit
    $(document).on('click', '.edit-user', function(){
        var id = $(this).data('id');
        $.get('ajax_user.php', {action:'edit', id:id}, function(res){
            $('#userModalLabel').text('Edit User');
            $('#userModalBody').html(res);
            $('#userModalFooter').html('<button type="submit" form="editUserForm" class="btn btn-primary">Simpan</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
            $('#userModal').modal('show');
        });
    });
    // Submit Edit
    $(document).on('submit', '#editUserForm', function(e){
        e.preventDefault();
        $.post('ajax_user.php', $(this).serialize()+'&action=update', function(res){
            $('#userModalBody').html(res);
            $('#userModalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        });
    });
    // Delete
    $(document).on('click', '.delete-user', function(){
        var id = $(this).data('id');
        $('#userModalLabel').text('Hapus User');
        $('#userModalBody').html('<div class="alert alert-danger">Yakin ingin menghapus user ini?</div>');
        $('#userModalFooter').html('<button class="btn btn-danger" id="confirmDeleteUser" data-id="'+id+'">Hapus</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
        $('#userModal').modal('show');
    });
    // Confirm Delete
    $(document).on('click', '#confirmDeleteUser', function(){
        var id = $(this).data('id');
        $.post('ajax_user.php', {action:'delete', id:id}, function(res){
            $('#userModalBody').html(res);
            $('#userModalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        });
    });
    // DataTables
    $('#userTable').DataTable({
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
        }
    });

});
</script>

<?php include 'footer.php'; ?>