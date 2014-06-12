<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_POST['fm'])){
		$data = array();

		foreach($_POST['fm'] as $key => $value){
			$data[] = $key."='".$value."'";
		}

		$datas = implode(", ", $data);
		
		$id = $_POST['fm']['id_produksi'];
		$field_id = "id_produksi";

		$table = "produksi";

		$sql = mysql_query("UPDATE ".$table." SET ".$datas." WHERE ".$field_id."='".$id."'");

		if(!$sql){
			echo mysql_error();
			exit();
		}

		header("Location:".DOMAIN."/page/produksi/view.php?id=".$id."&r=1");
	} else {
		header("Location:".DOMAIN."/404.php");
	}

?> 