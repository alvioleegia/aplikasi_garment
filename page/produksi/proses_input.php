<?php
require "../../config/config.php";

if(!isset($_POST['fm'])){ 
	echo "Process Error!"; 
	exit();
}

$field = array();
$data = array();

foreach($_POST['fm'] as $key => $value){
	$field[] = $key;
	$data[] = "'".$value."'";
}

if(isset($_FILES['fm']) && isset($_FILES['fm']['name']['gambar'])){
	$image = $_POST['fm']['gambar'];
    //Stores the filename as it was on the client computer.
    $imagename = $_FILES['fm']['name']['gambar'];
    //Stores the filetype e.g image/jpeg
    $imagetype = $_FILES['fm']['type']['gambar'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['fm']['error']['gambar'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['fm']['tmp_name']['gambar'];
    $newname = Date("YmdHis").'-'.$imagename;

    //The path you wish to upload the image to
    $imagePath = SITE_ROOT."images/produksi/";

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $newname)) {
            //echo "Sussecfully uploaded your image.";
            $field[] = 'gambar';
            $data[] = "'".$newname."'";
        }
        else {
            echo "Failed to move your image.";
            exit();
        }
    }
    else {
        echo "Failed to upload your image.";
        exit();
    }
} 

$fields = implode(", ", $field);
$datas = implode(", ", $data);
$table = "produksi";

$sql = mysql_query("INSERT INTO ".$table."(".$fields.") VALUES(".$datas.")");

if ($sql){
	$id_produksi = mysql_insert_id();
	
	if(!empty($_POST["spesifikasi"])){
		foreach ($_POST["spesifikasi"] as $id_spesifikasi => $id_sub_spesifikasi) 
		{
			$sql_spesifikasi = "INSERT INTO produksi_spesifikasi (id_produksi, id_spesifikasi, id_sub_spesifikasi) VALUES('".$id_produksi."', '".$id_spesifikasi."', '".$id_sub_spesifikasi."' )";
			$q_spesifikasi = mysql_query($sql_spesifikasi);

			if(!$q_spesifikasi)
			{
			 echo 'Could not run query: ' . mysql_error();
			 exit();
			}
		}
	}

	if(!empty($_POST['warna'])){
		foreach ($_POST['warna'] as $key => $warna) 
		{
			foreach ($warna as $id_jenis_warna => $jumlah) {
				$id_kain = $key;

				$sql_warna = "INSERT INTO produksi_warna (id_produksi, id_kain, id_jenis_warna, pemakaian) VALUES('".$id_produksi."','".$id_kain."', '".$id_jenis_warna."', '".$jumlah."' )";
				$q_warna = mysql_query($sql_warna);

				if(!$q_warna)
				{
					 echo 'Could not run query: ' . mysql_error();
					 exit();
				}
			}
		}
	}

	if(!empty($_POST["size"])){
 
		foreach ($_POST['size'] as $key => $value) 
		{
			$sql_size = "INSERT INTO produksi_size (id_produksi, id_size, jumlah) VALUES('".$id_produksi."', '".$key."', '".$value."' )";
			$q_size = mysql_query($sql_size);

			if(!$q_size)
			{
				echo 'Could not run query: ' . mysql_error();
				exit();

			}
		}

	}

	header('Location:view.php?id='.$id_produksi.'&q=1');
} else
    echo 'Could not run query: ' . mysql_error();


?>