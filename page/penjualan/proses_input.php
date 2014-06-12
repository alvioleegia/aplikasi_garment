<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_POST['fm'])){
		$field = array();
		$data = array();

		foreach($_POST['fm'] as $key => $value){
			$field[] = $key;
			$data[] = "'".$value."'";
		}

		$fields = implode(", ", $field);
		$datas = implode(", ", $data);

		$table = "spesifikasis";

		$sql = mysql_query("INSERT INTO ".$table."(".$fields.") VALUES(".$datas.")");

		if($sql){
			header("Location:".DOMAIN."/page/spesifikasi?r=2");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>