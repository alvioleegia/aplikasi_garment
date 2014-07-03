<?php $pageTitle = 'Laporan Penjualan'; $pageActive = 'penjualan'; ?>
<?php require('../../config/config.php'); require("../../config/session.php"); require("../../function.php");  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       <!-- bootstrap 3.0.2 -->
        <link href="<?php echo DOMAIN; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo DOMAIN; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo DOMAIN; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo DOMAIN; ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo DOMAIN; ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo DOMAIN; ?>/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo DOMAIN; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo DOMAIN; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo DOMAIN; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN; ?>/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.0.2 -->
        <script src="<?php echo DOMAIN; ?>/js/jquery-2.0.2.min.js"></script>

        <!-- Bootstrap -->
        <script src="<?php echo DOMAIN; ?>/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- date-range-picker -->
        <script src="<?php echo DOMAIN; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo DOMAIN; ?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <script src="<?php echo DOMAIN; ?>/js/plugins/validation/jqBootstrapValidation.js" type="text/javascript"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo DOMAIN; ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo DOMAIN; ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    </head>
<body class="skin-blue">

	<style type="text/css">
	    @media print {
	      @page 
	      {
	          size: auto;   /* auto is the initial value */
	          margin: 0mm;  /* this affects the margin in the printer settings */
	          size: potrait;
	      }
	    }
	</style>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="table-responsive">
				<section class="content laporan">
					<div class="page-header text-center">
						<h3>
							<img src="<?php echo DOMAIN; ?>/img/logo_2.png" class="logo-sm">PT. Cipta Gemilang Sentosa
						</h3>
						<small>
							Jl. Raya Banjaran KM. 15,5 No.492 Bandung 40376<br>
							Telp: 022-5940685 Fax: 5940136
						</small>
					</div>
					<div class="text-center page-header">
						<h5>Laporan penjualan 
						<?php
							if(isset($_GET['rekap']) && $_GET['rekap'] == 'periode' && isset($_GET['periode'])){
								$date = explode("-", $_GET['periode']);
								$start = $date[0].'-'.$date[1].'-'.$date[2];
								$end = $date[3].'-'.$date[4].'-'.$date[5];

								echo dateFormat($start).' - '.dateFormat($end);
							} else if(isset($_GET['rekap'])) {
								echo ucfirst($_GET['rekap']);
							}
						?>
						</h5>
					</div>
					<?php
						if(!isset($_GET['rekap']) || isset($_GET['rekap']) && $_GET['rekap'] == 'tahunan'){
	                		$tahun = date("Y");
	                		$bulan = $i < 10 ? "0".$i : $i; 
	                		$start = $tahun."-01-"."01"; 
	                		$end = $tahun."-12-"."31";
						} else if(isset($_GET['rekap']) && $_GET['rekap'] == 'bulanan'){
							$tahun = date("Y");
	                		$bulan = date("m");
	                		$start = $tahun."-".$bulan."-"."01"; 
	                		$end = $tahun."-".$bulan."-"."31";
						} else if(isset($_GET['rekap']) && $_GET['rekap'] == 'periode' && isset($_GET['periode'])){
							$date = explode("-", $_GET['periode']);
							$start = $date[0].'-'.$date[1].'-'.$date[2];
							$end = $date[3].'-'.$date[4].'-'.$date[5];
						}

						$loop = 0;

						// get all produksi
						$produksis = mysql_query("SELECT * FROM produksi WHERE tanggal_pemesanan >= '".$start."' && tanggal_pemesanan <= '".$end."' ");
						$penjualans = mysql_query("SELECT * FROM penjualan WHERE type='2'");
						
						$penjualan_arr = array();
						while ($penjualan = mysql_fetch_array($penjualans)) {
							$penjualan_arr[] = $penjualan['id_produksi'];
						}

						$count = 0;
						while ($produksi = mysql_fetch_array($produksis)) {
							if(in_array($produksi['id_produksi'], $penjualan_arr)){
								$loop++;
					?>
						<?php
						    // Menghitung jumlah potong barang
						    $jml_pesanan = 0;
						    $sql = mysql_query("SELECT * FROM produksi_size where id_produksi=".$produksi['id_produksi']);

						    if($sql){
						        while($row = mysql_fetch_row($sql)) {
						            $jml_pesanan += $row[3];
						        }
						    }
						    //echo $jml_pesanan;

						    // Menghitung harga kain/potong
						    $total_harga_kain = 0;
						    $sql = mysql_query("SELECT * FROM produksi_warna where id_produksi=".$produksi['id_produksi']);
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
						    $sql = mysql_query("SELECT * FROM produksi_spesifikasi where id_produksi=".$produksi['id_produksi']);
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

						    $jenis_barang = dataJenisBarang($produksi['id_jenis_barang']);
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

						<table class="table table-bordered">
							<thead>
								
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="col-xs-7">
											<b><?php echo $produksi['nama']; ?></b><br>
											<?php echo $produksi['alamat']; ?><br>
											<?php echo $produksi['no_tlp']; ?>
										</div>
										<div class="col-xs-5">
											<b>Order ID:</b> <?php echo $produksi['kode_produksi']; ?><br>
											<b>Tgl. Pemesanan:</b> <?php echo dateFormat($produksi['tanggal_pemesanan']); ?><br>
											<b>Tgl. Selesai:</b> <?php echo dateFormat($produksi['tanggal_selesai']); ?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<table class="table table-bordered table-condensed no-margin">
											<thead>
												<tr>
													<th>Qty</th>
													<th>Item</th>
													<th>Size</th>
													<th>Harga/pcs</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?php echo $jml_pesanan; ?></td>
													<td><?php echo $jenis_barang['barang']; ?></td>
													<td>
														<?php $q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$produksi['id_produksi']); ?>
								                        <?php $count_size = mysql_num_rows($q); ?>
								                        <?php $i = 1; ?>
								                        <?php while($row = mysql_fetch_array($q)): ?>
								                            <?php echo getSize($row['id_size']); ?>
								                            <?php if($i < $count_size) echo ',&nbsp;'; ?>
								                            <?php $i++; ?>
								                        <?php endwhile; ?>
													</td>
													<td>Rp <?php echo getMoneyFormat($harga_satuan); ?></td>
													<td>Rp <?php echo getMoneyFormat($total_harga); ?></td>
												</tr>
												<tr>
													<td colspan="4" class="text-right"><b>Laba + Overhead Pabrik (30%)</b></td>
													<td>Rp <?php echo getMoneyFormat($fee_perusahaan); ?></td>
												</tr>
												<tr>
													<td colspan="4" class="text-right"><b>Total Harga Kain Keseluruhan</b></td>
													<td>Rp <?php echo getMoneyFormat($total_harga_kain); ?></td>
												</tr>
												<tr>
													<td colspan="4" class="text-right"><b>Total Harga Spesifikasi Keseluruhan</b></td>
													<td>Rp <?php echo getMoneyFormat($total_harga_spesifikasi); ?></td>
												</tr>
												<tr>
													<td colspan="4" class="text-right"><b>Jasa Jahit</b></td>
													<td>Rp <?php echo getMoneyFormat($harga_jasa); ?></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>

						<?php  if($loop % 3 == 0){
							echo "<div class='page-break'></div>";
						} ?>
					<?php
							}	
						}
					?>
				</section>
			</div>
		</div>
	</section><!-- /.content -->

<!-- AdminLTE App -->
<script src="<?php echo DOMAIN; ?>/js/AdminLTE/app.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {	
		window.print();
	})
</script>
</body>
</html>