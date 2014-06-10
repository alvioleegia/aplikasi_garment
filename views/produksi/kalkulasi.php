<?php
	include "../header.php"; 
?>
<div class="container">
<form role="form" id="form_input" action="proses_edit.php" method="post">
	<?php require "../../config/config.php"; ?>
	<?php
		if(isset($_GET['id'])){

			$id_produksi = $_GET['id'];
			$q = "SELECT * FROM produksi where id_produksi= $id_produksi";
			$result = mysql_query($q) or die(mysql_error());

			if($result){
			    $row = mysql_fetch_array($result) or die(mysql_error()); 
			}
		} else {
			echo "Id Produksi Required";
			exit;
		}
	?>

    
	<!-- Kolom kiri -->
	<div class="col-md-7">
		<h1>Kalkulasi</h1>

		<?php if(isset($_GET['q']) && $_GET['q'] == 1){ ?>
 			<div class="alert alert-success">
      			<strong>Data Berhasil Ditambahkan!</strong>
    		</div>
		<?php } ?>

		<?php if(isset($_GET['q']) && $_GET['q'] == 2){ ?>
 			<div class="alert alert-success">
      			<strong>Data Berhasil Diupdate!</strong>
    		</div>
		<?php } ?>

		<div class="form-group">
			<label for="nama">Nama Pemesan</label>
			<div><?php echo $row['nama']; ?></div>
		</div>
		<div class="form-group">
			<label for="tanggal_pemesanan">Tanggal Pemesanan</label>
			<div><?php echo $row['tanggal_pemesanan']; ?></div>
		</div>
		<div class="form-group">
			<label for="tanggal_selesai">Tanggal Selesai</label>
			<div><?php echo $row['tanggal_selesai'];    ?></div>
		</div>
		<div class="form-group">
			<label for="jenis_barang">Jenis Barang</label>
			<?php
				$q = "SELECT * FROM jenis_barang where id_jenis_barang=".$row['id_jenis_barang'];;
				$result = mysql_query($q) or die(mysql_error());
				$jenis_barang = mysql_fetch_array($result);

				$qty_per_kg = $jenis_barang['qty_per_kg'];
				$harga_jasa = $jenis_barang['harga_jasa'];
			?>
			<div><?php echo $jenis_barang['barang']; ?></div>
		</div>
		<div class="form-group">
			<label for="deskripsi">Deskripsi</label>
			<div><?php echo $row['deskripsi'];    ?></div>
		</div>

		<div class="form-group">
			<?php
				if(isset($_GET['id'])){
					$id_produksi = $_GET['id'];

					// Menghitung jumlah potong barang
					$jml_pesanan = 0;
					$q_size = "SELECT * FROM produksi_size where id_produksi=$id_produksi";
					$result_size = mysql_query($q_size) or die(mysql_error());

					if($result){
					    while($row = mysql_fetch_row($result_size)) {
					    	$jml_pesanan += $row[3];
						}
					}

					// Menghitung harga kain/potong
					$harga_kain_by_warna = 0;
					$q_warna = "SELECT * FROM produksi_warna where id_produksi=$id_produksi";
					$result_warna = mysql_query($q_warna) or die(mysql_error());
					if($result_warna){
					    while($row = mysql_fetch_row($result_warna)) {
					    	$q2 = "SELECT * FROM jenis_warna WHERE id_jenis_warna=".$row[3];
					    	$result2 = mysql_query($q2);
					    	if ($result2) {
					    		$warna = mysql_fetch_array($result2) or die(mysql_error());

					    		//echo $warna['warna'].' '.($warna['harga'] * ($row[4]/100)).'<br>';
					    		$harga_kain_by_warna += $warna['harga'] * ($row[4]/100);
					    	}
						}
					}

				} else {
					echo "Id Produksi Required";
					exit;
				}
			?>
			<?php
				// echo $jml_pesanan."<br>";
				// echo $qty_per_kg."<br>";
				// echo $harga_kain_by_warna."<br>";
				// echo $harga_jasa."<br>";
				// rumus
				$spesifikasi = 0;
				$lusin = floor($jml_pesanan / 12);
				// echo $lusin."<br>";
				// echo ($harga_jasa * $lusin)."<br>";
				if(!$qty_per_kg){
					$bersih = 0;
				} else {
					$bersih = ((($jml_pesanan / $qty_per_kg) * $harga_kain_by_warna) + $spesifikasi + ($harga_jasa * $lusin));	
				}
				$total = $bersih + ($bersih * (30/100));

			?>
			<label for="deskripsi">TOTAL HARGA</label>
			<div>Rp. <?php echo number_format($total); ?></div>
		</div>
	</div>

	<!-- Kolom Kanan -->
	<div class="col-md-5">

		<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2 ){ ?>
		<h2>Spesifikasi</h2>
		
		<table class="table table-hover" id="table_spesifikasi">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Banyaknya</th>
					<th></th>
			
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){

						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_spesifikasi where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());

						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM spesifikasis where id_spesifikasi=$row[2]";
						    	$result2 = mysql_query($q2);
						    	if($result2){
			 					   $spesifikasi = mysql_fetch_array($result2) or die(mysql_error()); 
								}


						    	echo "<td>".$spesifikasi['spesifikasi']."</td>";
						    	echo "<td>".$row[4]."</td>";
								echo "</tr>";
							}
						}


					} else {
						echo "Id Produksi Required";
						exit;
					}
				?>
			</tbody>		
		</table>
		<?php } ?>

		<h2>Kain</h2>
		
		<table class="table table-hover" id="table_kain">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Pamakaian</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){
						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_warna where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());
						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM jenis_warna WHERE id_jenis_warna=".$row[3];
						    	$result2 = mysql_query($q2);
						    	if ($result2) {
						    		$warna = mysql_fetch_array($result2) or die(mysql_error());
						    	}
						    	$q3 = "SELECT * FROM kains where id_kain=".$row[2];
						    	$result3 = mysql_query($q3);
						    	if($result3){
			 					   $kain = mysql_fetch_array($result3) or die(mysql_error()); 
								}


						    	echo "<td>(".$kain['kain'].") ".$warna['warna']."</td>";
						    	echo "<td>".$row[4]."%</td>";
								echo "</tr>";
							}
						}


					} else {
						echo "Id Produksi Required";
						exit;
					}
				?>
			</tbody>		
		</table>

		<h2>Size</h2>
		
		<table class="table table-hover" id="table_size">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Banyaknya</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){

						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_size where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());

						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM sizes where id_size=$row[2]";
						    	$result2 = mysql_query($q2);
						    	if($result2){
			 					   $size = mysql_fetch_array($result2) or die(mysql_error()); 
								}


						    	echo "<td>".$size['size']."</td>";
						    	echo "<td>".$row[3]."</td>";
						    	echo "</tr>";
							}
						}


					} else {
						echo "Id Produksi Required";
						exit;
					}
				?>

			</tbody>		
		</table> 
		

	</div>


<input type="hidden" name="id_produksi" value="<?php echo $id_produksi; ?>">;

</form>
</div>

<script type="text/javascript">
    $(function(){
    	 $('body').on('click','.btn-hapus',function(e){

            var hapus = confirm("Hapus?");

            if(!hapus){
            	return false;
            }

         });
    });
</script>


</body>
</html>