<?php $pageTitle = 'Edit Kain'; $pageActive = 'kain'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Kain</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kain</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM kains WHERE id_kain=$id");
			$data = mysql_fetch_array($sql);
		?>

		<form role="form" action="proses_edit.php" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Kain #<?php echo $data['id_kain']; ?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Kain</label>
								<input type="text" class="form-control" name="fm[kain]" value="<?php echo $data['kain']; ?>">
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

			<input type="hidden" name="fm[id_kain]" value="<?php echo $data['id_kain']; ?>">
		</form>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>