<?php
	function getUserInfo($field){
		if(isset($_SESSION['id_user'])){
			$q = mysql_query("select * from user where id_user='$_SESSION[id_user]'");
			$data = mysql_fetch_array($q);

			return $data[$field];
		}

		return false;
	}

	function getUserLevel($level = null){

		if(!$level){
			$level = getUserInfo('level');	
		}

		if($level){
			switch ($level) {
				case 1:
					$level = 'Superadmin';
					break;
				
				case 2:
					$level = 'PPC';
					break;

				case 3:
					$level = 'Sales';
					break;

				default:
					$level = 'Customer';
					break;
			}

			return $level;
		}

		return false;
	}

	function getKain($id){
		$q = mysql_query("select * from kains where id_kain='$id'");
		$data = mysql_fetch_array($q);

		return $data['kain'];
	}

	function getWarna($id){
		$q = mysql_query("select * from jenis_warna where id_jenis_warna='$id'");
		$data = mysql_fetch_array($q);

		return $data['warna'];
	}

	function getSize($id){
		$q = mysql_query("select * from sizes where id_size='$id'");
		$data = mysql_fetch_array($q);

		return $data['size'];
	}

	function getSpesifikasi($id){
		$q = mysql_query("select * from spesifikasis where id_spesifikasi='$id'");
		$data = mysql_fetch_array($q);

		return $data['spesifikasi'];
	}

	function getSubSpesifikasi($id){
		$q = mysql_query("select * from sub_spesifikasi where id_sub_spesifikasi='$id'");
		$data = mysql_fetch_array($q);

		return $data['nama'];
	}

	function getCountSpesifikasi($id_produksi){
		$q = mysql_query("SELECT COUNT(*) FROM produksi_spesifikasi WHERE id_produksi=".$id_produksi);
		$data = mysql_result($q,0);
	
		return $data;	
	}

	function getJumlahProduksi($id_produksi){
		$q = mysql_query("SELECT * FROM produksi_size WHERE id_produksi=".$id_produksi);

		$jml = 0;
		while($row = mysql_fetch_array($q)){
			$jml += $row['jumlah'];
		}

		return $jml;
	}

	function dateFormat($date){
		$date = new DateTime($date);
		$result = $date->format('d M, Y');

		return $result;
	}


	function getJenisBarang($id){
		$q = mysql_query("SELECT * FROM jenis_barang WHERE id_jenis_barang=".$id);
		$data = mysql_fetch_array($q);

		return $data['barang'];
	}

?>