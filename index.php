<?php $pageTitle = 'PT Cipta Gemilang Sentosa'; ?>
<?php include 'header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blank page
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="col-lg-8">
		<h1>Aplikasi PPC</h1>
		<?php if($_SESSION['level']==1){ ?>

		 <a class="btn btn-primary btn-lg" href="/aplikasi_garment/views/produksi">PRODUKSI</a>
		 <a class="btn btn-success btn-lg" href="/aplikasi_garment/views/kain">KAIN</a>
		 <a class="btn btn-info btn-lg" href="/aplikasi_garment/produksi">WARNA</a>
		 <a class="btn btn-warning btn-lg" href="/aplikasi_garment/produksi">SIZE</a>
		 <a class="btn btn-danger btn-lg" href="/aplikasi_garment/produksi">SPESIFIKASI</a>
		 <br/>
		 <br/>
		 <a class="btn btn-primary" href="/aplikasi_garment/views/user/logout.php">LOGOUT</a>
	
		<?php } else if($_SESSION['level']==2){ ?>
		 <a class="btn btn-primary btn-lg" href="/aplikasi_garment/views/produksi">PRODUKSI</a>
		 <a class="btn btn-success btn-lg" href="/aplikasi_garment/produksi">KAIN</a>
		 <a class="btn btn-info btn-lg" href="/aplikasi_garment/produksi">WARNA</a>
		 <a class="btn btn-warning btn-lg" href="/aplikasi_garment/produksi">SIZE</a>
		 <a class="btn btn-danger btn-lg" href="/aplikasi_garment/produksi">SPESIFIKASI</a>
		 <br/>
		 <br/>
		 
		 <a class="btn btn-primary" href="/aplikasi_garment/views/user/logout.php">LOGOUT</a>
		 <?php } else { ?>
			<a class="btn btn-primary" href="/aplikasi_garment/views/produksi/konsumen.php">DATA KONSUMEN</a>
			<a class="btn btn-primary" href="/aplikasi_garment/views/produksi/input.php">INPUT DATA</a>
		
			<br><br>
			<a class="btn btn-primary" href="/aplikasi_garment/views/user/logout.php">LOGOUT</a>
		<?php } ?>

	</div>
</section><!-- /.content -->

<?php include 'footer.php'; ?>