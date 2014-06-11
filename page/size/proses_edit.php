<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_POST['fm'])){
		$data = array();

		foreach($_POST['fm'] as $key => $value){
			$data[] = $key."='".$value."'";
		}

		$datas = implode(", ", $data);
		
		$id = $_POST['fm']['id_size'];

		$table = "sizes";

		$sql = mysql_query("UPDATE ".$table." SET ".$datas." WHERE id_size='".$id."'");

		if($sql){
			header("Location:".DOMAIN."/page/size/view.php?id=".$id."&r=1");
		} else {
			echo mysql_error();
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}
?>