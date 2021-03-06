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
		<h1>Detail</h1>

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
			?>
			<div><?php echo $jenis_barang['barang']; ?></div>
		</div>
		<div class="form-group">
			<label for="deskripsi">Deskripsi</label>
			<div><?php echo $row['deskripsi'];    ?></div>
		</div>

		<div class="form-group">
		<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2 ){ ?>
		
			<a href="kalkulasi.php?id=<?PHP echo $id_produksi; ?>" class="btn btn-mini btn-info" title='kalkulasi'><i class="glyphicon glyphicon-upload"></i> Kalkulasi </a> 
			<a href="edit.php?id=<?PHP echo $id_produksi; ?>" class="btn btn-mini btn-warning" title='Edit'> <i class="glyphicon glyphicon-edit"></i> Update</a>
  			<a href="delete.php?id=<?PHP echo $id_produksi; ?>" class="btn btn-mini btn-danger btn-hapus" title='hapus'><i class="glyphicon glyphicon-remove"></i> Hapus </a>
		
		<?php } else{ ?>
			<a href="/aplikasi_garment/views/produksi/konsumen.php" class="btn btn-mini btn-warning" title='Manage Konsumen'><i class="glyphicon glyphicon-edit"></i> Manage Konsumen</a>

		<?php } ?>
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
					<th class="col-md-4">Pemakaian</th>
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