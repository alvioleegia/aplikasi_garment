<?php
require "../../config/config.php";

if(!isset($_POST['kain'])){ 
	echo "Process Error!"; 
	exit();
}

$sql = "INSERT INTO kains (id_kain, kain) VALUES('".$_POST['id_kain']."', '".$_POST['kain']."')";

$q = mysql_query($sql);

if ($q){
	$id_kain = mysql_insert_id();


	header('Location:view.php?id='.$id_kain.'&q=1');
} else
    echo 'Could not run query: ' . mysql_error();


?>