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

		<?php
            // Menghitung jumlah potong barang
            $jml_pesanan = 0;
            $sql = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id);

            if($sql){
                while($row = mysql_fetch_row($sql)) {
                    $jml_pesanan += $row[3];
                }
            }
            //echo $jml_pesanan;

            // Menghitung harga kain/potong
            $total_harga_kain = 0;
            $sql = mysql_query("SELECT * FROM produksi_warna where id_produksi=".$id);
            if($sql){
                while($row = mysql_fetch_row($sql)) {
                    $sql_warna = mysql_query("SELECT * FROM jenis_warna WHERE id_jenis_warna=".$row[3]);
                    if ($sql_warna) {
                        $warna = mysql_fetch_array($sql_warna) or die(mysql_error());

                        //echo $warna['warna'].' '.($warna['harga'] * ($row[4]/100)).'<br>';
                        $total_harga_kain += $warna['harga'] * ($row[4]/100);
                    }
                }
            }
            //echo $total_harga_kain;

            // Menghitung harga spesifikasi
            $total_harga_spesifikasi = 0;
            $sql = mysql_query("SELECT * FROM produksi_spesifikasi where id_produksi=".$id);
            if($sql){
                while($row = mysql_fetch_row($sql)) {
                    $sql_spesifikasii = mysql_query("SELECT * FROM sub_spesifikasi WHERE id_sub_spesifikasi=".$row[3]);
                    if ($sql_spesifikasii) {
                        $spesifikasi = mysql_fetch_array($sql_spesifikasii) or die(mysql_error());

                        //echo $spesifikasi['nama'].' '.($spesifikasi['harga'] * $jml_pesanan).'<br>';
                        $total_harga_spesifikasi += $spesifikasi['harga'] * $jml_pesanan;
                    }
                }
            }
            //echo $total_harga_spesifikasi;

            $jenis_barang = dataJenisBarang($data['id_jenis_barang']);
            $qty_per_kg = $jenis_barang['qty_per_kg'];
            $harga_jasa = $jenis_barang['harga_jasa'];

            // echo $qty_per_kg;
            // echo $harga_jasa;

            // Menghitung total harga
            $lusin = ceil($jml_pesanan / 12);

            if(!$total_harga_kain){
                $harga_bersih = 0;
            } else {
                $harga_bersih = ((($jml_pesanan / $qty_per_kg) * $total_harga_kain) + $total_harga_spesifikasi + ($harga_jasa * $lusin));  
            }

            $fee_perusahaan = $harga_bersih * (30/100);

            $total_harga = $harga_bersih + $fee_perusahaan;

            $harga_satuan = $total_harga / $jml_pesanan;

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
                            <label>Kode Produksi</label>
                            <p><?php echo $data['kode_produksi']; ?></p>
                        </div>

						<div class="form-group">
							<label>Nama Pemesan</label>
							<p><?php echo $data['nama']; ?></p>
						</div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <p><?php echo $data['alamat']; ?></p>
                        </div>

                        <div class="form-group">
                            <label>No. Tlp</label>
                            <p><?php echo $data['no_tlp']; ?></p>
                        </div>

						<div class="form-group">
							<label>Status</label>
							<?php $status = getStatusProduksi($data['status']); ?>
							<p><span class="<?php echo $status['class']; ?>"><?php echo $status['text']; ?></span></p>
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

                        <?php if($_SESSION['level'] == 2): ?>
                            <?php if($data['status'] == 4){ ?>
                                <div class="form-group">
                                    <a href="<?php echo DOMAIN; ?>/page/produksi/cetak_produksi.php?id=<?php echo $data['id_produksi']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Surat Perintah Produksi</a>
                                </div>
                            <?php } ;?>
                        <?php endif; ?>

						<?php if($_SESSION['level'] != 4): ?>
							<p>
								<a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
							</p>
						<?php endif; ?>

						<?php if($_SESSION['level'] == 4 || $_SESSION['level'] == 1): ?>
	                        <form role="form" action="update_status.php" method="post">
								<div class="input-group form-group col-md-12">
	                                <select class="form-control " name="fm[status]">
	                                	<option value="2" <?php if($data['status'] == 2) echo 'selected'; ?>>Ready</option>
	                                    <option value="3" <?php if($data['status'] == 3) echo 'selected'; ?>>Uang Muka</option>
	                                    <option value="4" <?php if($data['status'] == 4) echo 'selected'; ?>>Produksi</option>
	                                    <option value="5" <?php if($data['status'] == 5) echo 'selected'; ?>>Pelunasan</option>
	                                    <option value="6" <?php if($data['status'] == 6) echo 'selected'; ?>>Selesai</option>
	                                    <option value="1" <?php if($data['status'] == 1) echo 'selected'; ?>>Cancel</option>
	                                </select>

		                            <span class="input-group-btn">
		                                <button type="submit" class="btn btn-primary">Update</button>
		                            </span>

		                            <input type="hidden" name="fm[id_produksi]" value="<?php echo $data['id_produksi']; ?>">
		                        </div>
	                        </form>

	                        <?php if($data['status'] == 3){ ?>
	                        	<div class="form-group">
	                        		<a href="<?php echo DOMAIN; ?>/page/produksi/cetak_uang_muka.php?id=<?php echo $data['id_produksi']; ?>" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i> Cetak Nota Uang Muka</a>
	                        	</div>
	                        <?php } else if($data['status'] == 5){ ?>
	                        	<div class="form-group">
	                        		<a href="" class="btn btn-warning"><i class="fa fa-print"></i> Cetak Nota Pelunasan</a>
	                        	</div>
	                        <?php } ?>
						<?php endif; ?>

						<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
							<div>
								<a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Anda yakin akan menghapus ini?')" class="btn btn-danger">Hapus</a>
							</div>
						<?php endif; ?>

					</div>
				</div>

				<?php if(($_SESSION['level'] == 1 || $_SESSION['level'] == 4) && $data['status'] == 3): ?>
					<form role="form" action="update_penjualan.php" method="post">
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Uang Muka</h3>
							</div>
							<div class="box-body">
								<?php $sql = mysql_query("SELECT * FROM penjualan WHERE id_produksi=".$data['id_produksi']." && type=1"); ?>
								<?php if(mysql_num_rows($sql)){ ?>
									<?php $row = mysql_fetch_array($sql); ?>
									<table class="table table-condensed">
		                            	<tr>
			                                <th>Tanggal Waktu</th>
			                                <th>Nilai</th>
										</tr>
										<tr>
											<td><?php echo dateFormat($row['tanggal_waktu'], true); ?></td>
											<td>Rp <?php echo getMoneyFormat($row['nilai']); ?></td>
										</tr>
									</table>
								<?php } else { ?>
									<div class="form-group">
										<input type="text" name="fm[nilai]" class="form-control" placeholder="Rp. nilai uang muka" required>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<input type="hidden" name="fm[id_produksi]" value="<?php echo $data['id_produksi']; ?>">
										<input type="hidden" name="fm[type]" value="1">
										<input type="hidden" name="fm[tanggal_waktu]" value="<?php echo Date('Y-m-d H:i:s'); ?>">
									</div>
								<?php } ?>
 								
							</div>
						</div>
					</form>
				<?php endif; ?>

				<?php if(($_SESSION['level'] == 1 || $_SESSION['level'] == 4) && $data['status'] == 5): ?>
					<form role="form" action="update_penjualan.php" method="post">
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Pelunasan</h3>
							</div>
							<div class="box-body">
								<?php $cek_pelunasan = mysql_query("SELECT * FROM penjualan WHERE id_produksi=".$data['id_produksi']." && type=2"); ?>
								<?php if( !mysql_num_rows($cek_pelunasan) ): ?>
									<?php $sql = mysql_query("SELECT * FROM penjualan WHERE id_produksi=".$data['id_produksi']." && type=1"); ?>
									<?php if(mysql_num_rows($sql)){ ?>
										<div class="form-group">
											<table class="table table-condensed">
												<?php while($row = mysql_fetch_array($sql)): ?>
													<tr>
														<?php $tipe = getTipePenjualan($row['type']); ?>
														<td><?php echo $tipe['text']; ?></td>
														<td>Rp <?php echo getMoneyFormat($row['nilai']); ?></td>
														<td><?php echo dateFormat($row['tanggal_waktu'], true); ?></td>
													</tr>

													
														<tr class="bg-gray">
															<td><b>Sisa</b></td>
															<td colspan="2">
																<?php $sisa = $total_harga - $row['nilai']; ?>
																<b>Rp <?php echo getMoneyFormat($sisa); ?></b>
															</td>
														</tr>
													
												<?php endwhile; ?>
											</table>
										</div>
									<?php } ?>
								<?php endif; ?>


								<?php $sql = mysql_query("SELECT * FROM penjualan WHERE id_produksi=".$data['id_produksi']." && type=2"); ?>
								<?php if(mysql_num_rows($sql)){ ?>
									<?php $row = mysql_fetch_array($sql); ?>
									<table class="table table-condensed">
		                            	<tr>
			                                <th>Tanggal Waktu</th>
			                                <th>Nilai</th>
										</tr>
										<tr>
											<td><?php echo dateFormat($row['tanggal_waktu'], true); ?></td>
											<td>Rp <?php echo getMoneyFormat($row['nilai']); ?></td>
										</tr>
									</table>
								<?php } else { ?>
									<div class="form-group">
										<input type="text" name="fm[nilai]" class="form-control" placeholder="Rp. nilai pelunasan" value="<?php echo round($sisa); ?>" required>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<input type="hidden" name="fm[id_produksi]" value="<?php echo $data['id_produksi']; ?>">
										<input type="hidden" name="fm[type]" value="2">
										<input type="hidden" name="fm[tanggal_waktu]" value="<?php echo Date('Y-m-d H:i:s'); ?>">
									</div>
								<?php } ?>
 								
							</div>
						</div>
					</form>
				<?php endif; ?>

				<?php if(($_SESSION['level'] == 1 || $_SESSION['level'] == 4) && $data['status'] == 6): ?>
					<form role="form" action="update_penjualan.php" method="post">
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Pembayaran</h3>
							</div>
							<div class="box-body">
								<?php $sql = mysql_query("SELECT * FROM penjualan WHERE id_produksi=".$data['id_produksi']); ?>
								<?php if(mysql_num_rows($sql)){ ?>
									
									<table class="table table-condensed">
		                            	<tr>
		                            		<th>Tipe</th>
			                                <th>Tanggal Waktu</th>
			                                <th>Nilai</th>
										</tr>
										<?php while($row = mysql_fetch_array($sql)): ?>
											<tr>
												<?php $tipe = getTipePenjualan($row['type']); ?>
												<td><?php echo $tipe['text']; ?>
												<td><?php echo dateFormat($row['tanggal_waktu'], true); ?></td>
												<td>Rp <?php echo getMoneyFormat($row['nilai']); ?></td>
											</tr>
										<?php endwhile; ?>
									</table>
								<?php } else { ?>
									<div class="form-group">
										<input type="text" name="fm[nilai]" class="form-control" placeholder="Rp. nilai pelunasan" required>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<input type="hidden" name="fm[id_produksi]" value="<?php echo $data['id_produksi']; ?>">
										<input type="hidden" name="fm[type]" value="2">
										<input type="hidden" name="fm[tanggal_waktu]" value="<?php echo Date('Y-m-d H:i:s'); ?>">
									</div>
								<?php } ?>
 								
							</div>
						</div>
					</form>
				<?php endif; ?>

				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Gambar</h3>
					</div>
					<div class="box-body">
						<?php if($data['gambar']): ?>
							<img class="img-responsive" src="<?php echo DOMAIN; ?>/images/produksi/<?php echo $data['gambar']; ?>">
						<?php endif; ?>
					</div>
				</div>
				
			</div>

            <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 4): ?>
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Total Biaya</h3>
                            <div class="box-tools pull-right">
                                <a class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
                            <div class="alert alert-success alert-dismissable">
                                <i class="fa fa-check"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <b>Success!</b> Data updated.
                            </div>
                            <?php endif; ?>

                            <?php $i = 1; ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Item</th>
                                    <th style="width: 135px">Jumlah/Pemakaian</th>
                                    <th>Harga</th>
                                </tr>

                                <?php $sql = mysql_query("SELECT * FROM produksi_warna WHERE id_produksi=".$data['id_produksi']); ?>
                                <?php while($row = mysql_fetch_array($sql)): ?>
                                    <tr>
                                        <td><?php echo $i; ?>.</td>
                                        <td>Kain <?php echo getKain($row['id_kain']);?> <?php echo getWarna($row['id_jenis_warna']); ?> (<?php echo getHargaWarna($row['id_jenis_warna']); ?>/kg)</td>
                                        <td><?php echo $row['pemakaian']; ?>%</td>
                                        <td>Rp <?php echo getMoneyFormat((getHargaWarna($row['id_jenis_warna']) * $row['pemakaian'] / 100)); ?></td>
                                    </tr>
                                <?php $i++; ?>
                                <?php endwhile; ?>

                                <tr >
                                    <td colspan="2" class="text-right">
                                        <b>Total harga kain</b>
                                    </td>
                                    <td>1 kg</b></td>
                                    <td><b>Rp <?php echo getMoneyFormat($total_harga_kain); ?></b></td>
                                </tr>
                                <tr class="bg-gray">
                                    <td colspan="2" class="text-right">
                                        <b>Total harga <?php echo $jenis_barang['barang']; ?> (<?php echo $qty_per_kg; ?> potong/kg)</b>
                                    </td>
                                    <td><b><?php echo ($jml_pesanan / $qty_per_kg); ?> kg</b></td>
                                    <td><b>Rp <?php echo getMoneyFormat((($jml_pesanan / $qty_per_kg) * $total_harga_kain)); ?></b></td>
                                </tr>

                                <?php $sql = mysql_query("SELECT * FROM produksi_spesifikasi WHERE id_produksi=".$data['id_produksi']); ?>
                                <?php while($row = mysql_fetch_array($sql)): ?>
                                    <tr>
                                        <td><?php echo $i; ?>.</td>
                                        <td>
                                            <?php echo getSpesifikasi($row['id_spesifikasi']); ?> <?php echo getSubSpesifikasi($row['id_sub_spesifikasi']); ?> (<?php echo getMoneyFormat(getHargaSubSpesifikasi($row['id_sub_spesifikasi'])); ?>)
                                        </td>
                                        <td><?php echo $jml_pesanan; ?></td>
                                        <td>Rp <?php echo getMoneyFormat((getHargaSubSpesifikasi($row['id_sub_spesifikasi']) * $jml_pesanan)); ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endwhile; ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>Fee Jasa (<?php echo getMoneyFormat($harga_jasa); ?>/lusin)</td>
                                    <td><?php echo $lusin; ?></td>
                                    <td>Rp <?php echo getMoneyFormat(($harga_jasa * $lusin)); ?></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <b>Harga Bersih</b>
                                    </td>
                                    <td><b>Rp <?php echo getMoneyFormat($harga_bersih); ?></b></td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="text-right">
                                        <b>Fee Perusahaan (30%)</b>
                                    </td>
                                    <td><b>Rp <?php echo getMoneyFormat($fee_perusahaan); ?></b></td>
                                </tr>

                                <tr >
                                    <td colspan="3" class="text-right">
                                        <b>Harga/pcs</b>
                                    </td>
                                    <td><b>Rp <?php echo getMoneyFormat($harga_satuan); ?></b></td>
                                </tr>

                                <tr class="bg-gray">
                                    <td colspan="3" class="text-right">
                                        <b>Total Harga</b>
                                    </td>
                                    <td><b>Rp <?php echo getMoneyFormat($total_harga); ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
		</div>
	<?php } else { ?>
		<?php include '../404.php'; ?>
	<?php } ?>

</section><!-- /.content -->

<?php include '../footer.php'; ?>