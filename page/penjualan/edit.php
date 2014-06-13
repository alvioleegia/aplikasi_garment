<?php $pageTitle = 'Edit Penjualan'; $pageActive = 'penjualan'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Penjualan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM penjualan WHERE id_penjualan=$id");
			$data = mysql_fetch_array($sql);
		?>

		<form role="form" action="proses_edit.php" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Penjualan #<?php echo $data['id_penjualan']; ?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Produksi</label>
								<div>
									<?php echo getProduksi($data['id_produksi']); ?> <a href="<?php echo DOMAIN; ?>/page/produksi/view.php?id=<?php echo $data['id_produksi']; ?>" target="_blank" class="btn btn-xs btn-primary" title="Lihat detail"><i class="fa fa-search"></i></a>
								</div>
							</div>
							<div class="form-group">
								<label>Tanggal Waktu</label>
								<input type="text" class="form-control" name="fm[tanggal_waktu]" value="<?php echo $data['tanggal_waktu']; ?>">
							</div>
							<div class="form-group">
								<label>Tipe</label>
								<select class="form-control" name="fm[type]">
									<option value="1" <?php if($data['type'] == 1) echo 'selected'; ?>>Uang Muka</option>
									<option value="2" <?php if($data['type'] == 2) echo 'selected'; ?>>Pelunasan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nilai</label>
								<input type="text" class="form-control" name="fm[nilai]" value="<?php echo $data['nilai']; ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box box-warning">
						<div class="box-header">
							<h3 class="box-title">Action</h3>
						</div>
						<div class="box-body">
							<p>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</p>
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="fm[id_penjualan]" value="<?php echo $data['id_penjualan']; ?>">
		</form>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>