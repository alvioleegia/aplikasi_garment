<?php
require "../../config/config.php";
if(isset($_GET['id'])){

	$id_kain = $_GET['id'];
	$sqlkain="DELETE FROM kains WHERE id_kain='$id_kain'";
	
	$qkain=mysql_query($sqlkain);

	if ($qkain)
	{ 	
	    header('Location:/aplikasi_garment/views/kain/index.php?q=3');
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