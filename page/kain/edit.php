<?php $pageTitle = "Update Kain";?>
<?php include '../header.php'; ?>
<div class="container">
<form role="form" id="update_kain" action="proses_edit.php" method="post">
	<?php require "../../config/config.php"; ?>
	<?php
		if(isset($_GET['id'])){

			$id_kain = $_GET['id'];
			$q = "SELECT * FROM kains where id_kain= $id_kain";
			$result = mysql_query($q) or die(mysql_error());

			if($result){
			    $row = mysql_fetch_array($result) or die(mysql_error()); 
			}
		} else {
			echo "Id Kain Required";
			exit;
		}
	?>

	<!-- Kolom kiri -->
	<div class="col-md-7">
		<h1>Update Kain </h1>
		<div class="form-group">
			<label for="nama">Nama Kain</label>
			<input type="text" class="form-control" id="kain" name="kain" value="<?php echo $row['kain'] ?>";>
		</div>
		<div class="form-group">
		<button class="btn btn-primary ">Submit</button>
		</div>

	</div>			
	<input type="hidden" name="id_kain" value="<?php echo $id_kain ?>";>
</form>
</div>

	
</body>
</html>