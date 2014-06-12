<?php $pageTitle = 'Manage Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Produksi</li>
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
		            <h3 class="box-title">Data Produksi</h3>
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
		            <table class="table table-hover" id="table_data">
						<tr>
							<th>ID</th>
							<th>Nama Pemesan</th>
							<th>Tanggal Pemesanan</th>
							<th>Spesifikasi</th>
							<th>Jumlah</th>
							<th>Action</th>
						</tr>

						<?php $sql = mysql_query("SELECT * FROM produksi ORDER BY id_produksi DESC"); ?>
						<?php while($row = mysql_fetch_array($sql)): ?>
							<tr>
								<td><?php echo $row['id_produksi']; ?></td>
								<td><?php echo $row['nama']; ?></td>
								<td>
									<?php echo dateFormat($row['tanggal_pemesanan']); ?> s/d <?php echo dateFormat($row['tanggal_selesai']); ?>
								</td>
								<td><?php echo getCountSpesifikasi($row['id_produksi']); ?></td>
								<td><?php echo getJumlahProduksi($row['id_produksi']); ?></td>
								<td>
									<a class="btn btn-primary btn-xs" title="Lihat" href="view.php?id=<?php echo $row['id_produksi']; ?>">
										<i class="glyphicon glyphicon-search"></i>
									</a>
									<a class="btn btn-warning btn-xs" title="Edit" href="edit.php?id=<?php echo $row['id_produksi']; ?>">
										<i class="glyphicon glyphicon-edit"></i>
									</a>
									<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
										<a class="btn btn-danger btn-xs" title="Hapus" href="delete.php?id=<?php echo $row['id_produksi']; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')">
											<i class='glyphicon glyphicon-remove'></i>
										</a>
									<?php endif; ?>
								</td>
							</tr>

						<?php endwhile; ?>
					</table>
		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<?php include '../footer.php'; ?>
