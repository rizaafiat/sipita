<?php
$thisPage = "Data Permohonan Informasi";
session_start();
include 'header.php';
?>

<title><?php echo htmlspecialchars($thisPage); ?></title>
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h1 class="display-5 mb-3">
                <i class="fa fa-file-text fa-fw"></i>
                <?php echo htmlspecialchars($thisPage); ?>
            </h1>
        </div>
    </div>

<?php
// Ambil data permohonan dengan PDO
if (!isset($connection)) {
    die('<div class="alert alert-danger">Koneksi database gagal. Pastikan config.php sudah benar.</div>');
}
try {
    $stmt = $connection->query("SELECT * FROM permohonan_informasi ORDER BY id DESC");
    $permohonan = $stmt->fetchAll();
} catch (PDOException $e) {
    die('<div class="alert alert-danger">Query gagal: '.htmlspecialchars($e->getMessage()).'</div>');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
<!--                 <div class="card-header bg-white">
                  <button class="btn btn-success btn-sm float-end" id="addNewBtn"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div> 
-->
                <div class="card-body">

                    <!-- Filter Status -->
                <div class="mb-2">
                    <label for="filterStatus" class="form-label">Filter Status:</label>
                    <select id="filterStatus" class="form-select" style="width:auto;display:inline-block;">
                        <option value="">Semua Status</option>
                        <option value="Submit">Submit</option>
                        <option value="Proses Sepenuhnya">Proses Sepenuhnya</option>
                        <option value="Proses Sebagian">Proses Sebagian</option>
                        <option value="Selesai (Sepenuhnya)">Selesai (Sepenuhnya)</option>
                        <option value="Selesai (Sebagian)">Selesai (Sebagian)</option>
                        <option value="Ditolak (Dikecualikan)">Ditolak (Dikecualikan)</option>
                        <option value="Ditolak (Tidak Dikuasai)">Ditolak (Tidak Dikuasai)</option>
                        <option value="Ditolak (Bukan Kewenangan)">Ditolak (Bukan Kewenangan)</option>
                    </select>
                </div>

                    <table class="table table-bordered table-striped" id="permohonanTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Tiket</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Pekerjaan</th>
                                    <th>Instansi</th>
                                    <th>Rincian Data</th>
                                    <th>Alasan Permohonan</th>
                                    <th>Tujuan Penggunaan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no=1; 
                            if ($permohonan && count($permohonan) > 0):
                                foreach($permohonan as $row): 
                                    /* // Hitung overdue
                                    $tgl_submit = strtotime($row['tanggal_permohonan']);
                                    $now = strtotime(date('Y-m-d'));
                                    $selisih_hari = floor(($now - $tgl_submit) / (60*60*24));

                                    // Status selesai atau ditolak
                                    $is_selesai = in_array($row['status_proses'], [
                                        'Selesai (Sepenuhnya)',
                                        'Selesai (Sebagian)',
                                        'Ditolak (Dikecualikan)',
                                        'Ditolak (Tidak Dikuasai)',
                                        'Ditolak (Bukan Kewenangan)'
                                    ]);
                                    // Overdue jika status selesai/ditolak dan selisih hari > 4
                                    $is_overdue = $is_selesai && ($selisih_hari > 4);
 */                            ?>
                                    <tr <?php if($is_overdue) echo 'class="table-danger"'; ?>>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nomor_tiket']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal_permohonan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['pekerjaan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['instansi']); ?></td>
                                    <td><?php echo htmlspecialchars($row['rincian_data']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alasan_permohonan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tujuan_penggunaan']); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($row['status_proses']); ?>
<!--                                         <?php if($is_overdue): ?>
                                            <span class="badge bg-danger ms-1">Overdue</span>
                                        <?php endif; ?> -->
                                    </td>                                    <td>
                                        <button class="btn btn-info btn-sm view-btn" data-id="<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; 
                                else:
                                    echo '<tr><td colspan="6" class="text-center">Tidak ada data permohonan.</td></tr>';
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal View/Edit/Delete/Tambah -->
<div class="modal fade" id="permohonanModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Konten dinamis -->
      </div>
      <div class="modal-footer" id="modalFooter">
        <!-- Tombol dinamis -->
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
    // Tambah Baru
    $('#addNewBtn').on('click', function(){
        $('#modalLabel').text('Tambah Permohonan Baru');
        var formHtml = '<form id="addForm">'+
            '<div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>'+
            '<div class="mb-3"><label class="form-label">Tanggal Permohonan</label><input type="date" name="tanggal_permohonan" class="form-control" required></div>'+
            '<div class="mb-3"><label class="form-label">Status</label><select name="status_proses" class="form-select"><option value="Proses">Proses</option><option value="Selesai">Selesai</option><option value="Ditolak">Ditolak</option></select></div>'+
            '<div class="mb-3"><label class="form-label">Telepon</label><input type="text" name="telepon" class="form-control" required></div>'+
            '<div class="mb-3"><label class="form-label">Rincian Data</label><textarea name="rincian_data" class="form-control" required></textarea></div>'+
            '<div class="mb-3"><label class="form-label">Alasan Permohonan</label><textarea name="alasan_permohonan" class="form-control" required></textarea></div>'+
            '</form>';
        $('#modalBody').html(formHtml);
        $('#modalFooter').html('<button type="submit" form="addForm" class="btn btn-success">Simpan</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
        $('#permohonanModal').modal('show');
    });
    // Submit Tambah
    $(document).on('submit', '#addForm', function(e){
        e.preventDefault();
        $.post('ajax_permohonan.php', $(this).serialize()+'&action=add', function(res){
            $('#modalBody').html(res);
            $('#modalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        });
    });
    // View
    $(document).on('click', '.view-btn', function(){
        var id = $(this).data('id');
        $.get('ajax_permohonan.php', {action:'view', id:id}, function(res){
            $('#modalLabel').text('Detail Permohonan');
            $('#modalBody').html(res);
            $('#modalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            $('#permohonanModal').modal('show');
        });
    });
    // Edit
    $(document).on('click', '.edit-btn', function(){
        var id = $(this).data('id');
        $.get('ajax_permohonan.php', {action:'edit', id:id}, function(res){
            $('#modalLabel').text('Update Status Permohonan');
            $('#modalBody').html(res);
            $('#modalFooter').html('<button type="submit" form="editForm" class="btn btn-primary">Simpan</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
            $('#permohonanModal').modal('show');
        });
    });
    // Submit Edit
    $(document).on('submit', '#editForm', function(e){
    e.preventDefault();
    var form = this;
    var data = new FormData(form);
    data.append('action', 'update');
    $.ajax({
        url: 'ajax_permohonan.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            $('#modalBody').html(res);
            $('#modalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        }
    });
});
    // Delete
    $(document).on('click', '.delete-btn', function(){
        var id = $(this).data('id');
        $('#modalLabel').text('Hapus Permohonan');
        $('#modalBody').html('<div class="alert alert-danger">Yakin ingin menghapus permohonan ini?</div>');
        $('#modalFooter').html('<button class="btn btn-danger" id="confirmDelete" data-id="'+id+'">Hapus</button> <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>');
        $('#permohonanModal').modal('show');
    });
    // Confirm Delete
    $(document).on('click', '#confirmDelete', function(){
        var id = $(this).data('id');
        $.post('ajax_permohonan.php', {action:'delete', id:id}, function(res){
            $('#modalBody').html(res);
            $('#modalFooter').html('<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            setTimeout(function(){ location.reload(); }, 1200);
        });
    });
    // DataTables
    var table = $('#permohonanTable').DataTable({
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
        }
    });

    // Filter status dengan combobox
        $('#filterStatus').on('change', function(){
            var val = $(this).val();
            // Kolom status ada di index ke-9 (mulai dari 0)
            table.column(9).search(val).draw();
        });
});
</script>

<?php include 'footer.php'; ?>