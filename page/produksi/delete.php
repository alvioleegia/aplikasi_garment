<?php
require "../../config/config.php";
if(isset($_GET['id'])){

	$id_produksi = $_GET['id'];
	$sqlproduksi="DELETE FROM produksi WHERE id_produksi='$id_produksi'";
	$sqlspesifikasi="DELETE FROM produksi_spesifikasi WHERE id_produksi='$id_produksi'";
	$sqlwarna="DELETE FROM produksi_warna WHERE id_produksi='$id_produksi'";
	$sqlsize="DELETE FROM produksi_size WHERE id_produksi='$id_produksi'";

	$qproduksi=mysql_query($sqlproduksi);
	$qspesifikasi=mysql_query($sqlspesifikasi);
	$qwarna=mysql_query($sqlwarna);
	$qsize=mysql_query($sqlsize);

	if ($qproduksi && $qspesifikasi && $qwarna && $qsize)
	{ 	
	    header("Location:/aplikasi_garment/views/produksi");
	}
	else
	{
	    echo "ERROR!";
	    // close connection 
	    mysql_close();
	}
} else {
	echo "Process Error!";
}
?>