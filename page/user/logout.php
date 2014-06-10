<?php
	require('../../config/config.php');

	session_start();
	unset($_SESSION['username']);
	session_destroy();
	header("Location:".DOMAIN."/page/user/login.php");
?>