<?php
	require '../../config/config.php';
	
	$id_kain = $_GET['id_kain'];
	if($id_kain){
		$warna['Status'] = 'OK';
 
		$q = 'SELECT * FROM jenis_warna WHERE id_kain='.$id_kain;
		$data = mysql_query($q);
		$result = array();

		while($row = mysql_fetch_array($data)){
	 		$result[] = $row;
	 	}
 
		$warna['data'] = $result;   
	} else {
		$warna['Status'] = 'Error: Warna undefined.';
	}
 	
	echo json_encode($warna);
?>