<?php
	require '../../config/config.php';
	
	$id_spesifikasi = $_GET['id_spesifikasi'];
	if($id_spesifikasi){
		$warna['Status'] = 'OK';
 
		$q = 'SELECT * FROM sub_spesifikasi WHERE id_spesifikasi='.$id_spesifikasi;
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