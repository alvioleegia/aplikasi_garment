<?php include '../header.php'; ?>
<div class="container">
	<div class="col-md=12">
		<h2>Data Produksi <?php if($_SESSION['level'] == 1){ ?> <a href="admin_input.php" class="btn btn-mini btn-primary">Tambah</a></h2><?php } ?>
		<table class="table table-stripped" id="table_data">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Pemesan</th>
				<th>Tanggal Pemesanan</th>
				<th>Spesifikasi</th>
				<th>Kain</th>
				<th>Size</th>
				<th></th>
		</tr>
	</thead>
	<tbody>
		
		<?php
		$result = mysql_query("SELECT * FROM produksi");
		while($row = mysql_fetch_array( $result )) {
			echo "<tr>";
			echo "	<td>".$row['id_produksi']."</td>";
			echo "	<td><a href='view.php?id=".$row['id_produksi']."'>".$row['nama']."</a></td>";
			echo "	<td>".$row['tanggal_pemesanan']." s/d " .$row['tanggal_selesai']."</td>";

			$spesifikasi = mysql_query("SELECT COUNT(*) FROM produksi_spesifikasi WHERE id_produksi=".$row['id_produksi']);
			$kain = mysql_query("SELECT COUNT(*) FROM produksi_warna WHERE id_produksi=".$row['id_produksi']);
			$size = mysql_query("SELECT COUNT(*) FROM produksi_size WHERE id_produksi=".$row['id_produksi']);
			echo "	<td>".mysql_result($spesifikasi,0)."</td>";
			echo "	<td>".mysql_result($kain,0)."</td>";
			echo "	<td>".mysql_result($size,0)."</td>";
			echo "	<td><a class='btn btn-mini btn-info btn-xs' title='Edit' href='edit.php?id=".$row['id_produksi']."''><i class='glyphicon glyphicon-edit'></i></button>";
			echo "	<a class='btn btn-mini btn-danger btn_hapus btn-xs' title='Hapus' href='delete.php?id=".$row['id_produksi']."''> <i class='glyphicon glyphicon-remove'></i></button></td>";
			echo "</tr>";

		}

		
		?>
	</tbody>


		</table>
	</div>
</div>
<script type="text/javascript">
    $(function(){
    	 $('body').on('click','.btn_hapus',function(e){

            var hapus = confirm("Hapus?");

            if(!hapus){
            	return false;
            }

         });
    });
</script>
</body>
</html>