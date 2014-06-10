<?php
	require("../../config/loginsession.php");
?>
<html>
<head>
	<title>Form Edit Produksi</title>
 		<link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/aplikasi_garment/css/style.css">
        <script type="text/javascript" src="/aplikasi_garment/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/aplikasi_garment/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<form role="form" id="form_input" action="proses_edit.php" method="post">
	<?php require "../../config/config.php"; ?>
	<?php
		if(isset($_GET['id'])){

			$id_produksi = $_GET['id'];
			$q = "SELECT * FROM produksi where id_produksi= $id_produksi";
			$result = mysql_query($q) or die(mysql_error());

			if($result){
			    $row = mysql_fetch_array($result) or die(mysql_error()); 
			}
		} else {
			echo "Id Produksi Required";
			exit;
		}
	?>

    
	<!-- Kolom kiri -->
	<div class="col-md-7">
		<h1>Form Input</h1>
				<div class="form-group">
					<label for="nama">Nama Pemesan</label>
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'];     ?>">
				</div>
				<div class="form-group">
					<label for="tanggal_pemesanan">Tanggal Pemesanan</label>
					<input type="text" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?php echo $row['tanggal_pemesanan'];     ?>">
				</div>
				<div class="form-group">
					<label for="tanggal_selesai">Tanggal Selesai</label>
					<input type="text" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo $row['tanggal_selesai'];     ?>">
				</div>
				<div class="form-group">
					<label class="col-md-12 row" for="spesifikasi">Spesifikasi</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="spesifikasi">
								<?php
									$sql = " SELECT * from spesifikasis";
									$result = mysql_query($sql);
									while($row = mysql_fetch_row($result)) {
										echo "<option value='$row[0]'>".$row[1]."</option>";
									}
								?>		
						</select>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary tambah_spesifikasi ">Tambah</button>
					</div>
					<div class="clearfix"></div>	
				</div>

				<div class="form-group">
					<label class="col-md-12 row" for="kain">Kain</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="kain">
								<?php
									$sql = " SELECT * from kains";
									$result = mysql_query($sql);
									while($row = mysql_fetch_row($result)) {
										echo "<option value='$row[0]'>".$row[1]."</option>";
									}
								?>
						</select>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary tambah_kain">Tambah</button>
					</div>
					<div class="clearfix"></div>
				</div>
 
				<div class="form-group">
					<label class="col-md-12 row" for="size">Size</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="size">
								<?php
									$sql = " SELECT * from sizes";
									$result = mysql_query($sql);
									while($row = mysql_fetch_row($result)) {
										echo "<option value='$row[0]'>".$row[1]."</option>";
									}
								?>
						</select>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary tambah_size">Tambah</button>
					</div>
					<div class="clearfix"></div>	
				</div>
				
		
	</div>

	<!-- Kolom Kanan -->
	<div class="col-md-5">
		<h2>Spesifikasi</h2>
		
		<table class="table table-hover" id="table_spesifikasi">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Banyaknya</th>
					<th></th>
			
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){

						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_spesifikasi where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());

						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM spesifikasis where id_spesifikasi=$row[2]";
						    	$result2 = mysql_query($q2);
						    	if($result2){
			 					   $spesifikasi = mysql_fetch_array($result2) or die(mysql_error()); 
								}


						    	echo "<td>".$spesifikasi['spesifikasi']."</td>";
						    	echo "<td><div class='col-md-9 row'><input type='text' placeholder='0' class='form-control input-spesifikasi' value='$row[4]' name='spesifikasi[".$row[2]."]'></div></td>";
						    	echo "<td><a href='delete.php?id_produksi=".$id_produksi."' class='btn btn-mini btn-danger tipsy-kiri-atas' title='Hapus'> <i class='glyphicon glyphicon-remove'></i> </a></td>";
								echo "</tr>";
							}
						}


					} else {
						echo "Id Produksi Required";
						exit;
					}
				?>
			</tbody>		
		</table>

		<h2>Kain</h2>
		
		<table class="table table-hover" id="table_kain">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Pemakaian</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){
						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_warna where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());
						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM jenis_warna WHERE id_jenis_warna=".$row[3];
						    	$result2 = mysql_query($q2);
						    	if ($result2) {
						    		$warna = mysql_fetch_array($result2) or die(mysql_error());
						    	}
						    	$q3 = "SELECT * FROM kains where id_kain=".$row[2];
						    	$result3 = mysql_query($q3);
						    	if($result3){
			 					   $kain = mysql_fetch_array($result3) or die(mysql_error()); 
								}


						    	echo "<td>(".$kain['kain'].") ".$warna['warna']."</td>";
						    	echo "<td><div class='col-md-10 row'><input class = 'form-control' value = '$row[4]'></div>%</td>";
								echo "</tr>";
							}
						}


					} else {
						echo "Id Kain Required";
						exit;
					}
				?>
			</tbody>		
		</table>

		<h2>Size</h2>
		
		<table class="table table-hover" id="table_size">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Banyaknya</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_GET['id'])){

						$id_produksi = $_GET['id'];
						$q = "SELECT * FROM produksi_size where id_produksi=$id_produksi";
						$result = mysql_query($q) or die(mysql_error());

						if($result){
						    while($row = mysql_fetch_row($result)) {
						    	echo "<tr>";

						    	$q2 = "SELECT * FROM sizes where id_size=$row[2]";
						    	$result2 = mysql_query($q2);
						    	if($result2){
			 					   $size = mysql_fetch_array($result2) or die(mysql_error()); 
								}


						    	echo "<td>".$size['size']."</td>";
						    	echo "<td><div class='col-md-10 row'><input class = 'form-control' value = '$row[3]'></div></td>";
							   	echo "</tr>";
							}
						}


					} else {
						echo "Id Produksi Required";
						exit;
					}
				?>

			</tbody>		
		</table> 
		<button class="btn btn-primary ">Submit</button>



	</div>


<input type="hidden" name="id_produksi" value="<?php echo $id_produksi; ?>">;

</form>
</div>



<script type="text/javascript">
    $(function(){
        
        $('.tambah_spesifikasi').on('click',function(e){
            e.preventDefault();

            var value =  $('#spesifikasi').val();
            var text = $('#spesifikasi option:selected').text()

            if(!value){
                    alert("Pilih spesifikasi!");
                    return false;
            }

            var el = '';
            el += '<tr>';
            el += ' <td>'+text+'</td>';
            el += ' <td><div class="col-md-9 row"><input type="text" placeholder="0" class="form-control input-spesifikasi" name="spesifikasi['+value+']"></div></td>';
            el += '<td><button type="button" class="btn btn-danger btn-sm hapus_spesifikasi">Hapus</button></td>'
            el += '</tr>';

            $('#table_spesifikasi').append(el);
        });

		$('.tambah_kain').on('click',function(e){
            e.preventDefault();

            var value =  $('#kain').val();
            var text = $('#kain option:selected').text()

            if(!value){
                    alert("Pilih Jenis Kain!");
                    return false;
            }

            var el = '';
            el += '<tr>';
            el += ' <td>'+text+'</td>';
            el += ' <td><div class="col-md-9 row"><input type="text" placeholder="0" class="form-control input-kain" name="kain['+value+']"></div></td>';
            el += '<td><button type="button" class="btn btn-danger btn-sm hapus_kain">Hapus</button></td>'
            el += '</tr>';

            $('#table_kain').append(el);
        });

        $('.tambah_size').on('click',function(e){
            e.preventDefault();

            var value =  $('#size').val();
            var text = $('#size option:selected').text()
            if(!value){
                    alert("Pilih Size!");
                    return false;
            }

            var el = '';
            el += '<tr>';
            el += ' <td>'+text+'</td>';
            el += ' <td><div class="col-md-9 row"><input type="text" placeholder="0" class="form-control input-size" name="size['+value+']"></div></td>';
            el += '<td><button type="button" class="btn btn-danger btn-sm hapus_size">Hapus</button></td>'
            el += '</tr>';

            $('#table_size').append(el);
        });
     
     	$('body').on('click','.hapus_spesifikasi',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
      
            	$(this).parents('tr').remove();
            }
        });

     	$('body').on('click','.hapus_kain',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
      
            	$(this).parents('tr').remove();
            }
        });

        $('body').on('click','.hapus_size',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
      
            	$(this).parents('tr').remove();
            }
        });

        $('#form_input').submit(function(){
        	if(!$('body').find('.input-spesifikasi').length){
        		alert("Tambahkan Spesifikasi!");
        		return false;
        	}
        	if(!$('body').find('.input-kain').length){
        		alert("Tambahkan Jenis Kain!");
        		return false;
        	}
        	if(!$('body').find('.input-size').length){
        		alert("Tambahkan Size!");
        		return false;
        	}
        });
        
    });
</script>

</body>
</html>