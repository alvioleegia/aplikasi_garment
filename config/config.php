<?php
	define('DOMAIN', 'http://localhost/aplikasi_garment');
	define('PAGE_TITLE', 'PT Cipta Gemilang Sentosa'); // default page title
	define('SITE_ROOT', dirname(__FILE__).'/../');

	$dbname	= "aplikasi_garment";
	$dbusername = "root";
	$dbpass = "";
	$dbhost = "localhost";

	$connection=mysql_connect("$dbhost", "$dbusername", "$dbpass");
	if (!$connection) 
	{
		die("Could not connect:	" .mysql_error());
	} else {

		$dbcheck = mysql_select_db("$dbname");
		if (!$dbcheck) 
		{
			echo mysql_error();
		} 

	}
?> 