<?php
	session_start();
	if(!isset($_SESSION['id_user'])){
		header("Location:".DOMAIN."/page/user/login.php");
	}
?>