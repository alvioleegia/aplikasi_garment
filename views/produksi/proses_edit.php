<?php
require "../../config/config.php";
if(isset($_POST['id_produksi'])){

	$id_produksi=$_POST['id_produksi']; 
	$nama=$_POST['nama'];
	$tanggal_pemesanan=$_POST['tanggal_pemesanan'];
	$tanggal_selesai=$_POST['tanggal_selesai'];

	$sql="UPDATE produksi SET nama = '$nama', tanggal_pemesanan = '$tanggal_pemesanan', tanggal_selesai = '$tanggal_selesai' WHERE id_produksi = '$id_produksi'";
	$query = mysql_query($sql)
	or die('Error querying database.');

	if($query ){
		header('Location:view.php?id='.$id_produksi.'&q=2');

	}

}

?> 