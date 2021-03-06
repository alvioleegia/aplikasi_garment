<?php $pageTitle = 'Manage Sub Spesifikasi'; $pageActive = 'sub_spesifikasi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage
        <small>Sub Spesifikasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Sub Spesifikasi</li>
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
		            <h3 class="box-title">Data Sub Spesifikasi</h3>
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsive">
		            <table class="table table-hover" id="table_data">
		            	<thead>
			            	<tr>
			                    <th>ID</th>
			                    <th>Spesifikasi</th>
			                    <th>Sub</th>
			                    <th>Harga Satuan</th>
			                    <th>Action</th>
			                </tr>
		            	</thead>
		                <tbody>
			                <?php $sql = mysql_query('SELECT * FROM sub_spesifikasi ORDER BY id_sub_spesifikasi DESC'); ?>
			                <?php while($row = mysql_fetch_array($sql) ): ?>
				                <tr>
				                    <td><?php echo $row['id_sub_spesifikasi']; ?></td>
				                    <td><?php echo getSpesifikasi($row['id_spesifikasi']); ?></td>
				                    <td><?php echo $row['nama']; ?></td>
				                    <td><?php echo $row['harga']; ?></td>
				                    <td><a href="view.php?id=<?php echo $row['id_sub_spesifikasi']; ?>" class="btn btn-primary btn-xs">lihat</a> <a href="edit.php?id=<?php echo $row['id_sub_spesifikasi']; ?>" class="btn btn-warning btn-xs">edit</a> <a href="delete.php?id=<?php echo $row['id_sub_spesifikasi']; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger btn-xs">hapus</a></td>
				                </tr>
				            <?php endwhile; ?>	
		                </tbody>
		                
		            </table>
		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<script type="text/javascript">
    $(function() {
        $("#table_data").dataTable();
    });
</script>

<?php include '../footer.php'; ?>