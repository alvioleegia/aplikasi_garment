<?php $pageTitle = 'Tambah Size'; $pageActive = 'size'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input
        <small>Size</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Size</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<form role="form" action="proses_input.php" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Size Baru</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Barang</label>
							<?php $sql = mysql_query("SELECT * FROM jenis_barang ORDER BY barang ASC"); ?>
							<select name="fm[id_jenis_barang]" class="form-control">
								<?php while($row = mysql_fetch_array($sql)): ?>
									<option value="<?php echo $row['id_jenis_barang']; ?>"><?php echo $row['barang']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Size</label>
							<input type="text" class="form-control" name="fm[size]" >
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea name="fm[deskripsi]" class="form-control"></textarea>
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