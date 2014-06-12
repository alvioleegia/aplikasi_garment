<?php
	require '../../config/config.php';
	require '../../config/session.php';

	if(isset($_POST['fm'])){
		if(isset($_FILES['fm']) && $_FILES['fm']['name']['gambar'] != ''){
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
		            $_POST['fm']['gambar'] = $newname;
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

		if($_SESSION['level'] == 1 || $_SESSION['level'] == 2){	
			$sql = mysql_query("DELETE FROM produksi_spesifikasi WHERE ".$field_id."='".$id."'");
			if(!$sql){
				echo mysql_error();
				exit();
			}	
		}

		if(!empty($_POST["spesifikasi"])){

			foreach ($_POST["spesifikasi"] as $id_spesifikasi => $id_sub_spesifikasi) 
			{
				$sql_spesifikasi = "INSERT INTO produksi_spesifikasi (id_produksi, id_spesifikasi, id_sub_spesifikasi) VALUES('".$id."', '".$id_spesifikasi."', '".$id_sub_spesifikasi."' )";
				$q_spesifikasi = mysql_query($sql_spesifikasi);

				if(!$q_spesifikasi)
				{
					echo mysql_error();
					exit();
				}
			}
		}

		if(!empty($_POST['warna'])){
			$sql = mysql_query("DELETE FROM produksi_warna WHERE ".$field_id."='".$id."'");

			if(!$sql){
				echo mysql_error();
				exit();
			}

			foreach ($_POST['warna'] as $key => $warna) 
			{
				foreach ($warna as $id_jenis_warna => $jumlah) {
					$id_kain = $key;

					$sql_warna = "INSERT INTO produksi_warna (id_produksi, id_kain, id_jenis_warna, pemakaian) VALUES('".$id."','".$id_kain."', '".$id_jenis_warna."', '".$jumlah."' )";
					$q_warna = mysql_query($sql_warna);

					if(!$q_warna)
					{
						echo mysql_error();
						exit();
					}
				}
			}
		}

		if(!empty($_POST["size"])){
			$sql = mysql_query("DELETE FROM produksi_size WHERE ".$field_id."='".$id."'");

			if(!$sql){
				echo mysql_error();
				exit();
			}
 
			foreach ($_POST['size'] as $key => $value) 
			{
				$sql_size = "INSERT INTO produksi_size (id_produksi, id_size, jumlah) VALUES('".$id."', '".$key."', '".$value."' )";
				$q_size = mysql_query($sql_size);

				if(!$q_size)
				{
					echo mysql_error();
					exit();

				}
			}

		}

		if(isset($_GET['ref']) && $_GET['ref'] == 'kalkulasi'){
			header("Location:".DOMAIN."/page/produksi/edit.php?id=".$id."&r=1");
		} else {
			header("Location:".DOMAIN."/page/produksi/view.php?id=".$id."&r=1");
		}
	} else {
		header("Location:".DOMAIN."/404.php");
	}

?> 