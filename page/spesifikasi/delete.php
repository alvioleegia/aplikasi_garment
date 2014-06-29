<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$field_id = 'id_spesifikasi';
		$table = 'spesifikasis';

		$sql = mysql_query("DELETE FROM ".$table." WHERE ".$field_id."=".$id);
		$sql = mysql_query("DELETE FROM sub_spesifikasi WHERE ".$field_id."=".$id);

		if($sql){
			header("Location:".DOMAIN."/page/spesifikasi/?r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>