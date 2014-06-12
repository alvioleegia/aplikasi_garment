<?php $pageTitle = 'Manage User'; $pageActive = 'user'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage
        <small>User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage User</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	 <div class="row">
		<div class="col-xs-12">
			<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data terhapus.
	            </div>
            <?php endif; ?>
            <?php if(isset($_GET['r']) && $_GET['r'] == 2): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data berhasil ditambahkan.
	            </div>
            <?php endif; ?>
		    <div class="box">
		        <div class="box-header">
		            <h3 class="box-title">Data User</h3>
		            <div class="box-tools">
		                <div class="input-group">
		                    <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
		                    <div class="input-group-btn">
		                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		                    </div>
		                </div>
		            </div>
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsive no-padding">
		            <table class="table table-hover">
		                <tr>
		                    <th>ID</th>
		                    <th>Name</th>
		                    <th>Username</th>
		                    <th>Level</th>
		                    <th>Date Created</th>
		                    <th>Action</th>
		                </tr>
		                <?php $sql = mysql_query('SELECT * FROM user ORDER BY id_user DESC'); ?>
		                <?php while($row = mysql_fetch_array($sql) ): ?>
			                <tr>
			                    <td><?php echo $row['id_user']; ?></td>
			                    <td><?php echo $row['nama']; ?></td>
			                    <td><?php echo $row['username']; ?></td>
			                    <td><span class="label <?php if($row['level'] == 1){ echo 'label-warning'; } else if($row['level'] == 2){ echo 'label-success'; } else if($row['level'] == 4){ echo 'label-danger'; } else { echo 'label-primary'; } ?>"><?php echo getUserLevel($row['level']); ?></span></td>
			                    <td><?php echo $row['date_created']; ?></td>
			                    <td><a href="view.php?id=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">lihat</a> <a href="edit.php?id=<?php echo $row['id_user']; ?>" class="btn btn-warning btn-xs">edit</a> <a href="delete.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger btn-xs">hapus</a></td>
			                </tr>
			            <?php endwhile; ?>
		            </table>
		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<?php include '../footer.php'; ?>