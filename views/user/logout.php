<? 
	session_start();
	unset($_SESSION['username']);
	session_destroy();
	header("Location:/aplikasi_garment/views/user/login.php");
?>