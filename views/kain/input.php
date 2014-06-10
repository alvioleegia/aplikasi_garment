<?php
	require("../../config/loginsession.php");
?>
<html>
<head>
	<title>Form Input Produk</title>
 		<link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/style.css">
        <script type="text/javascript" src="/aplikasi_garment/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/aplikasi_garment/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<form role="form" id="form_input" action="proses_input_kain.php" method="post">
	<?php require "../../config/config.php"; ?>

	<!-- Kolom kiri -->
	<div class="col-md-7">
		<h1>Form Input</h1>
				<div class="form-group">
					<label for="nama">Nama Kain</label>
					<input type="text" class="form-control" id="kain" name="kain">
				</div>
				<div class="form-group">
				<button class="btn btn-primary ">Submit</button>
				</div>
					
	</div>

	
</body>
</html>