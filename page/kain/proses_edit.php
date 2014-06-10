<?php
require "../../config/config.php";
if(isset($_POST['id_kain'])){

	$id_kain=$_POST['id_kain']; 
	$kain=$_POST['kain'];
	
	$sql="UPDATE kains SET kain = '".$kain."'WHERE id_kain = '".$id_kain."'";
	$query = mysql_query($sql)
	or die(mysql_error());

	if($query ){
		header('Location:view.php?id='.$id_kain.'&q=2');

	}

}

?> 