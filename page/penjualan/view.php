<?php $pageTitle = 'View Penjualan'; $pageActive = 'penjualan'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Penjualan</li>
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

		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Penjualan #<?php echo $data['id_penjualan']; ?></h3>
					</div>
					<div class="box-body">

						<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
						<div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <b>Success!</b> Data updated.
                        </div>
	                    <?php endif; ?>
	                    <div class="form-group">
							<label>Produksi</label>
							<div>
								<?php echo getProduksi($data['id_produksi']); ?> <a href="<?php echo DOMAIN; ?>/page/produksi/view.php?id=<?php echo $data['id_produksi']; ?>" target="_blank" class="btn btn-xs btn-primary" title="Lihat detail"><i class="fa fa-search"></i></a>
							</div>
						</div>

						<div class="form-group">
							<label>Tanggal Waktu</label>
							<p><?php echo $data['tanggal_waktu']; ?></p>
						</div>

						<div class="form-group">
							<label>Tipe</label>
							<p>
								<?php $type = getTipePenjualan($data['type']); ?>
								<span class="<?php echo $type['class']; ?>"><?php echo $type['text']; ?></span>
							</p>
						</div>

						<div class="form-group">
							<label>Nilai</label>
							<p><?php echo $data['nilai']; ?></p>
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
							<a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
						</p>
						<p>
							<a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger">Hapus</a>
						</p>

					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>