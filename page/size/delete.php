<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$field_id = 'id_size';
		$table = 'sizes';

		$sql = mysql_query("DELETE FROM ".$table." WHERE ".$field_id."=".$id);

		if($sql){
			header("Location:".DOMAIN."/page/size/?r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>