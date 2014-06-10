<?php

session_start();
require "../../config/config.php";

$login = mysql_query("SELECT * FROM user where username = '" . $_POST['username'] . "' and password = '" . $_POST['password'] . "'");

$rowcount = mysql_num_rows($login);
if ($rowcount == 1) {
	$_SESSION['username'] = $_POST['username'];

	$result = mysql_fetch_array($login);

	$_SESSION['level'] = $result['level'];

	header("Location:".DOMAIN."/");
}
else
{
	header("Location:".DOMAIN."/views/user/login.php?ket=error");
}
?>