<?php $pageTitle = 'Edit Spesifikasi'; $pageActive = 'spesifikasi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Spesifikasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Spesifikasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM spesifikasis WHERE id_spesifikasi=$id");
			$data = mysql_fetch_array($sql);
		?>

		<form role="form" action="proses_edit.php" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Size #<?php echo $data['id_spesifikasi']; ?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Spesifikasi</label>
								<input type="text" class="form-control" name="fm[spesifikasi]" value="<?php echo $data['spesifikasi']; ?>">
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

			<input type="hidden" name="fm[id_spesifikasi]" value="<?php echo $data['id_spesifikasi']; ?>">
		</form>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>