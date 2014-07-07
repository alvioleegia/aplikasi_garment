<?php $pageTitle = 'Edit Size'; $pageActive = 'size'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Size</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Size</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM sizes WHERE id_size=$id");
			$data = mysql_fetch_array($sql);
		?>

		<form role="form" action="proses_edit.php" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Size #<?php echo $data['id_size']; ?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Jenis Barang</label>
								<?php $sql = mysql_query("SELECT * FROM jenis_barang ORDER BY barang ASC"); ?>
								<select name="fm[id_jenis_barang]" class="form-control">
									<?php while($row = mysql_fetch_array($sql)): ?>
										<option value="<?php echo $row['id_jenis_barang']; ?>" <?php if($row['id_jenis_barang'] == $data['id_jenis_barang']) echo 'selected'; ?>><?php echo $row['barang']; ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="fm[size]" value="<?php echo $data['size']; ?>">
							</div>
							<div class="form-group">
								<label>Deskripsi</label>
								<textarea name="fm[deskripsi]" class="form-control"><?php echo $data['deskripsi']; ?></textarea>
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

			<input type="hidden" name="fm[id_size]" value="<?php echo $data['id_size']; ?>">
		</form>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>