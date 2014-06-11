<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$field_id = 'id_jenis_warna';
		$table = 'jenis_warna';

		$sql = mysql_query("DELETE FROM ".$table." WHERE ".$field_id."=".$id);

		if($sql){
			header("Location:".DOMAIN."/page/warna/?r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>