<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$field_id = 'id_sub_spesifikasi';
		$table = 'sub_spesifikasi';

		$sql = mysql_query("DELETE FROM ".$table." WHERE ".$field_id."=".$id);

		if($sql){
			header("Location:".DOMAIN."/page/sub-spesifikasi/?r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>