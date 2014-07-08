<?php
	require '../../config/config.php';
	
	$id_jenis_barang = $_GET['id_jenis_barang'];
	if($id_jenis_barang){
		$size['Status'] = 'OK';
 
		$q = 'SELECT * FROM sizes WHERE id_jenis_barang='.$id_jenis_barang;
		$data = mysql_query($q);
		$result = array();

		while($row = mysql_fetch_array($data)){
	 		$result[] = $row;
	 	}
 
		$size['data'] = $result;   
	} else {
		$size['Status'] = 'Error: Warna undefined.';
	}
 	
	echo json_encode($size);
?>