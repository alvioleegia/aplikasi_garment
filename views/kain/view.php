<?php $pageTitle = "Detail Kain Baru"; ?>
	<?php
	include "../header.php"; 
?>
<div class="container">
<form role="form" id="form_input" action="proses_edit.php" method="post">
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
		<h1>Detail Kain</h1>

		<?php if(isset($_GET['q']) && $_GET['q'] == 1){ ?>
 			<div class="alert alert-success">
      			<strong>Data Berhasil Ditambahkan!</strong>
    		</div>
		<?php } ?>

		<?php if(isset($_GET['q']) && $_GET['q'] == 2){ ?>
 			<div class="alert alert-success">
      			<strong>Data Berhasil Diupdate!</strong>
    		</div>
		<?php } ?>


		<div class="form-group">
			<label for="nama">Kain</label>
			<div><?php echo $row['kain']; ?></div>
		</div>
		

		<div class="form-group">
		<?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2 ){ ?>
		
			<a href="edit.php?id=<?PHP echo $id_produksi; ?>" class="btn btn-mini btn-warning" title='Edit'> <i class="glyphicon glyphicon-edit"></i> Update</a>
  			<a href="delete.php?id=<?PHP echo $id_produksi; ?>" class="btn btn-mini btn-danger btn-hapus" title='hapus'><i class="glyphicon glyphicon-remove"></i> Hapus </a>
  			<a href="index.php" class="btn btn-mini btn-primary "title='Back'><i class="glyphicon glyphicon-arrow-left"></i> Kembali ke Daftar Kain</a>
		
		<?php } else{ ?>
			<a href="/aplikasi_garment/views/produksi/konsumen.php" class="btn btn-mini btn-warning" title='Manage Konsumen'><i class="glyphicon glyphicon-edit"></i> Manage Konsumen</a>

		<?php } ?>
		</div>
	</div>

	
	</div>


<input type="hidden" name="id_produksi" value="<?php echo $id_produksi; ?>">;

</form>
</div>

<script type="text/javascript">
    $(function(){
    	 $('body').on('click','.btn-hapus',function(e){

            var hapus = confirm("Hapus?");

            if(!hapus){
            	return false;
            }

         });
    });
</script>


</body>
</html>