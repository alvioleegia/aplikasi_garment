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

		$sql = mysql_query("DELETE FROM produksi_spesifikasi WHERE ".$field_id."='".$id."'");

		if(!$sql){
			echo mysql_error();
			exit();
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

		header("Location:".DOMAIN."/page/produksi/view.php?id=".$id."&r=1");
	} else {
		header("Location:".DOMAIN."/404.php");
	}

?> 