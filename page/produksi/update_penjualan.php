<?php
require "../../config/config.php";

print_r($_POST);
if(!isset($_POST['fm'])){ 
	echo "Process Error!"; 
	exit();
}

$id_produksi = $_POST['fm']['id_produksi'];

$field = array();
$data = array();

foreach($_POST['fm'] as $key => $value){
	$field[] = $key;
	$data[] = "'".$value."'";
}

$fields = implode(", ", $field);
$datas = implode(", ", $data);
$table = "penjualan";

$sql = mysql_query("INSERT INTO ".$table."(".$fields.") VALUES(".$datas.")");

if ($sql){
	header('Location:view.php?id='.$id_produksi.'&q=1');
} else {
    echo 'Could not run query: ' . mysql_error();
}


?>