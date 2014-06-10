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
		
		$id = $_POST['fm']['id_user'];

		$table = "user";

		$sql = mysql_query("UPDATE ".$table." SET ".$fields." VALUES(".$datas.") WHERE id_user='".$id."'");

		if($sql){
			header("Location:".DOMAIN."/page/user?r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>