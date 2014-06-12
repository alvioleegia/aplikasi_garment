<?php $pageTitle = 'View Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Produksi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	
	<?php if(isset($_GET['id'])){ ?>
		<?php
			$id = $_GET['id'];
			$sql = mysql_query("SELECT * FROM produksi WHERE id_produksi=$id");
			$data = mysql_fetch_array($sql);
		?>

		<div class="row">
			<div class="col-md-7">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Produksi #<?php echo $data['id_produksi']; ?></h3>
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
							<label>Nama Pemesan</label>
							<p><?php echo $data['nama']; ?></p>
						</div>

						<div class="form-group">
							<label>Tinggal Pemesanan</label>
							<p><?php echo dateFormat($data['tanggal_pemesanan']); ?></p>
						</div>

						<div class="form-group">
							<label>Tanggal Selesai</label>
							<p><?php echo dateFormat($data['tanggal_selesai']); ?></p>
						</div>

						<div class="form-group">
							<label>Jenis Barang</label>
							<p><?php echo getJenisBarang($data['id_jenis_barang']); ?></p>
						</div>

						<div class="form-group">
							<label>Deskripsi</label>
							<p><?php echo $data['deskripsi']; ?></p>
						</div>
					</div>
				</div>

				<?php
					// Retrive spesifikasi
					$q = mysql_query("SELECT * FROM produksi_spesifikasi where id_produksi=".$id); 
				?>

				<?php //if(mysql_num_rows($q)): ?>
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Spesifikasi</h3>
						</div>
						<div class="box-body">
							<table class="table table-condensed">
	                            <tr>
	                                <th style="width: 30px">#</th>
	                                <th>Spesifikasi</th>
	                                <th>Sub</th>
	                            </tr>
	                            
	                            <?php $i = 1; ?>
								<?php while($row = mysql_fetch_array($q)): ?>
		                            <tr>
		                                <td><?php echo $i; ?></td>
		                                <td><?php echo getSpesifikasi($row['id_spesifikasi']); ?></td>
		                                <td><?php echo getSubSpesifikasi($row['id_sub_spesifikasi']); ?></td>
		                            </tr>
		                            <?php $i++; ?>
	                        	<?php endwhile; ?>
	                        </table>
						</div>
					</div>
				<?php //endif; ?>

				<?php
					// Retrive Kain
					$q = mysql_query("SELECT * FROM produksi_warna where id_produksi=".$id); 
				?>

				<?php //if(mysql_num_rows($q)): ?>
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Kain</h3>
						</div>
						<div class="box-body">
							<table class="table table-condensed">
	                            <tr>
	                                <th style="width: 30px">#</th>
	                                <th>Kain</th>
	                                <th>Warna</th>
	                                <th>Pemakaian</th>
	                            </tr>
	                            
	                            <?php $i = 1; ?>
								<?php while($row = mysql_fetch_array($q)): ?>
		                            <tr>
		                                <td><?php echo $i; ?></td>
		                                <td><?php echo getKain($row['id_kain']); ?></td>
		                                <td><?php echo getWarna($row['id_jenis_warna']); ?></td>
		                                <td><?php echo $row['pemakaian']; ?>%</td>
		                            </tr>
		                            <?php $i++; ?>
	                        	<?php endwhile; ?>
	                        </table>
						</div>
					</div>
				<?php //endif; ?>

				<?php
					// Retrive Size
					$q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id); 
				?>

				<?php //if(mysql_num_rows($q)): ?>
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Size</h3>
						</div>
						<div class="box-body">
							<table class="table table-condensed">
	                            <tr>
	                                <th style="width: 30px">#</th>
	                                <th>Size</th>
	                                <th>Jumlah</th>
	                            </tr>
	                            
	                            <?php $i = 1; ?>
								<?php while($row = mysql_fetch_array($q)): ?>
		                            <tr>
		                                <td><?php echo $i; ?></td>
		                                <td><?php echo getSize($row['id_size']); ?></td>
		                                <td><?php echo $row['jumlah']; ?></td>
		                            </tr>
		                            <?php $i++; ?>
	                        	<?php endwhile; ?>
	                        </table>
						</div>
					</div>
				<?php //endif; ?>

			</div>
			<div class="col-md-5">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Action</h3>
					</div>
					<div class="box-body">
						<p>
							<a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
						</p>
						<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
							<p>
								<a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger">Hapus</a>
							</p>
						<?php endif; ?>

					</div>
				</div>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Gambar</h3>
					</div>
					<div class="box-body">
						<img class="img-responsive" src="<?php echo DOMAIN; ?>/img/tshirt.jpg">
					</div>
				</div>
				
			</div>
		</div>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>