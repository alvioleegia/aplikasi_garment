<?php $pageTitle = 'View Size'; $pageActive = 'size'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Size</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View user</li>
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

		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Size #<?php echo $data['id_size']; ?></h3>
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
							<label>Size</label>
							<p><?php echo $data['size']; ?></p>
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