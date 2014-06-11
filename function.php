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

	function getSpesifikasi($id){
		$q = mysql_query("select * from spesifikasis where id_spesifikasi='$id'");
		$data = mysql_fetch_array($q);

		return $data['spesifikasi'];
	}

?>