<?php

session_start();
require "../../config/config.php";

$login = mysql_query("SELECT * FROM user where username = '" . $_POST['username'] . "' and password = '" . $_POST['password'] . "'");

$rowcount = mysql_num_rows($login);
if ($rowcount == 1) {
	$data_user = mysql_fetch_array($login);
	$_SESSION['id_user'] = $data_user['id_user'];
	$_SESSION['level'] = $data_user['level'];

	header("Location:".DOMAIN."/");
}
else
{
	header("Location:".DOMAIN."/page/user/login.php?ket=error");
}
?>