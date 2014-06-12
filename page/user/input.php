<?php $pageTitle = 'Tambah User'; $pageActive = 'user'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input
        <small>User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input user</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<form role="form" action="proses_input.php" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User Baru</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="fm[nama]" >
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="fm[username]" >
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="fm[password]" >
						</div>
						<div class="form-group">
							<label>Level</label>
							<select class="form-control" name="fm[level]">
								<option value="4" >Penjualan</option>
								<option value="3" >Sales</option>
								<option value="2" >PPC</option>
								<option value="1" >Superadmin</option>
							</select>
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

		<input type="hidden" name="fm[date_created]" value="<?php echo date('Y-m-d'); ?>">
	</form>

</section><!-- /.content -->

<?php include '../footer.php'; ?>