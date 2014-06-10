<?php
require "../../config/config.php";

if(!isset($_POST['nama'])){ 
	echo "Process Error!"; 
	exit();
}

$sql = "INSERT INTO produksi (nama, tanggal_pemesanan, tanggal_selesai, deskripsi, id_jenis_barang) VALUES('".$_POST['nama']."', '".$_POST['tanggal_pemesanan']."', '".$_POST['tanggal_selesai']."', '".$_POST['deskripsi']."', '".$_POST['id_jenis_barang']."' )";

$q = mysql_query($sql);

if ($q){
	$id_produksi = mysql_insert_id();
	
	if(!empty($_POST["spesifikasi"])){

		foreach ($_POST['spesifikasi'] as $key => $value) 
		{
			$sql_spesifikasi = "INSERT INTO produksi_spesifikasi (id_produksi, id_spesifikasi, jumlah) VALUES('".$id_produksi."', '".$key."', '".$value."' )";
			$q_spesifikasi = mysql_query($sql_spesifikasi);

			if(!$q_spesifikasi)
				{
				 echo 'Could not run query: ' . mysql_error();
				 exit();
				}
		}
	}

	if(!empty($_POST['warna'])){
		foreach ($_POST['warna'] as $key => $value) 
		{
			$kain = mysql_fetch_array(mysql_query("SELECT * FROM jenis_warna WHERE id_jenis_warna=".$_POST['warna'])); 
			$id_kain = $key;

			$sql_warna = "INSERT INTO produksi_warna (id_produksi, id_kain, id_jenis_warna, pemakaian) VALUES('".$id_produksi."','".$id_kain."', '".$key."', '".$value."' )";
			$q_warna = mysql_query($sql_warna);

			if(!$q_warna)
				{
				 echo 'Could not run query: ' . mysql_error();
				 exit();

			}
		}
	}

	if(!empty($_POST["size"])){
 
		foreach ($_POST['size'] as $key => $value) 
		{
			$sql_size = "INSERT INTO produksi_size (id_produksi, id_size, jumlah) VALUES('".$id_produksi."', '".$key."', '".$value."' )";
			$q_size = mysql_query($sql_size);

			if(!$q_size)
			{
				echo 'Could not run query: ' . mysql_error();
				exit();

			}
		}

	}

	header('Location:view.php?id='.$id_produksi.'&q=1');
} else
    echo 'Could not run query: ' . mysql_error();


?>