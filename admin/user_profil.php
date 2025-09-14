<?php 
$thisPage = "Profil User";
include 'header.php';
?>

<title><?php echo $thisPage; ?></title>

<!-- Header -->
<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><span class="fa fa-user"> <?php echo $thisPage; ?></h2>
                </div>
</div>
<!-- End Header -->

<!-- Data  -->
<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<form class="form-horizontal" name="modal-popup" enctype="multipart/form-data">
				<div class="form-group">
                    <label class="col-lg-3 control-label">ID User</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['id']; ?>" readonly/>
                        </div>
                </div>
				<div class="form-group">
                    <label class="col-lg-3 control-label">Nama</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['nama']; ?>" readonly/>
                        </div>
                </div>
				<div class="form-group">
                    <label class="col-lg-3 control-label">Alamat</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['alamat']; ?>" readonly/>
                        </div>
                </div>
				<div class="form-group">
                    <label class="col-lg-3 control-label">Jenis Kelamin</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['jkel']; ?>" readonly/>
                        </div>
                </div>
				<div class="form-group">
                    <label class="col-lg-3 control-label">Nama Puskesmas</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['puskesmas']; ?>" readonly/>
                        </div>
                </div>
				<div class="form-group">
                    <label class="col-lg-3 control-label">Tipe User</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?php echo $_SESSION['tipe']; ?>" readonly/>
                        </div>
                </div>
															
			</form>
		</div>
</div>
</br>
</br>
</br>
</br>
</br>

<!-- End Data -->

<?php 
include 'footer.php';
?>