<?php $pageTitle = 'Edit User'; $pageActive = 'user'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit user</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM user WHERE id_user=$id");
			$data = mysql_fetch_array($sql);
		?>

		<form role="form" action="proses_edit.php" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">User #<?php echo $data['id_user']; ?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="fm[nama]" value="<?php echo $data['nama']; ?>">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="fm[username]" value="<?php echo $data['username']; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="fm[password]" value="<?php echo $data['password']; ?>">
							</div>
							<div class="form-group">
								<label>Level</label>
								<select class="form-control" name="fm[level]">
									<option value="1" <?php if($data['level'] == 1) echo 'selected'; ?>>Superadmin</option>
									<option value="2" <?php if($data['level'] == 2) echo 'selected'; ?>>PPC</option>
									<option value="3" <?php if($data['level'] == 3) echo 'selected'; ?>>Sales</option>
									<option value="4" <?php if($data['level'] == 4) echo 'selected'; ?>>Sales</option>
								</select>
							</div>
							<div class="form-group">
								<label>Date Created</label>
								<input type="text" class="form-control" name="fm[date_created]" value="<?php echo $data['date_created']; ?>">
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

			<input type="hidden" name="fm[id_user]" value="<?php echo $data['id_user']; ?>">
		</form>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>