<html>
<head>
	<title>Sales Admin</title>
	<link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/style.css">
    <script type="text/javascript" src="/aplikasi_garment/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/aplikasi_garment/js/bootstrap.min.js"></script>
</head>
<body>
<?php require "../../config/config.php"; ?>
<div class="container">
	<div class="col-md=12">
		<h2>Data Konsumen</h2>
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
			echo "</tr>";

		}

		
		?>
	</tbody>


		</table>
	</div>
</div>
</body>
</html>