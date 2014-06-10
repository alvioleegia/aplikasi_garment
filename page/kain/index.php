<?php $pageTitle = 'Daftar Kain'; ?>
<?php include '../header.php'; ?>
<div class="container">
	<div class="col-md=12">
		<h2>Daftar Kain <?php if($_SESSION['level'] == 1){ ?> <a href="input.php" class="btn btn-mini btn-primary">Tambah</a></h2><?php } ?>
				<?php if(isset($_GET['q']) && $_GET['q'] == 3){ ?>
 			<div class="alert alert-success">
      			<strong>Data Berhasil Dihapus!</strong>
    		</div>
		<?php } ?>
		<table class="table table-bordered" id="table_data">
		<thead>
			<tr>
				<th>#</th>
				<th>ID Kain</th>
				<th>Jenis Kain</th>
				<th></th>

		</tr>
	</thead>
	<tbody>
		
		<?php
		$result = mysql_query("SELECT * FROM kains");

		$i=0;
		while($row = mysql_fetch_array( $result )) {
			$i++;
			echo "<tr>";
			echo "	<td>".$i."</td>";
			echo "	<td>".$row['id_kain']."</a></td>";
			echo "	<td><a href='view.php?id=".$row['id_kain']."'>".$row['kain']."</td>";
			echo "	<td><center><a class='btn btn-mini btn-info btn-xs' title='Edit' href='edit.php?id=".$row['id_kain']."''><i class='glyphicon glyphicon-edit'></i></button>";
			echo "	<a class='btn btn-mini btn-danger btn_hapus btn-xs' title='Hapus' href='delete.php?id=".$row['id_kain']."''> <i class='glyphicon glyphicon-remove'></i></button></td>";
			echo "</tr>";

		}

		
		?>
	</tbody>


		</table>
	</div>
</div>
<script type="text/javascript">
    $(function(){
    	 $('body').on('click','.btn_hapus',function(e){

            var hapus = confirm("Hapus?");

            if(!hapus){
            	return false;
            }

         });
    });
</script>
</body>
</html>