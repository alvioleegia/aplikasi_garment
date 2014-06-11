<?php $pageTitle = 'Tambah Sub Spesifikasi'; $pageActive = 'sub_spesifikasi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input
        <small>Sub Spesifikasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Sub Spesifikasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<form role="form" action="proses_input.php" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Sub Spesifikasi Baru</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Spesifikasi</label>
							<select class="form-control" name="fm[id_spesifikasi]">
								<?php $q = mysql_query("SELECT * FROM spesifikasis ORDER BY id_spesifikasi ASC"); ?>
								<?php while($row = mysql_fetch_array($q)): ?>
									<option value="<?php echo $row['id_spesifikasi']; ?>" ><?php echo $row['spesifikasi']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Sub</label>
							<input type="text" class="form-control" name="fm[nama]" >
						</div>

						<div class="form-group">
							<label>Harga</label>
							<input type="text" class="form-control" name="fm[harga]" >
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
	</form>

</section><!-- /.content -->

<?php include '../footer.php'; ?>