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
<form role="form" id="form_input" action="proses_input.php" method="post">
	<?php require "../../config/config.php"; ?>

	<!-- Kolom kiri -->
	<div class="col-md-7">
		<h1>Form Input</h1>
				<div class="form-group">
					<label for="nama">Nama Pemesan</label>
					<input type="text" class="form-control" id="nama" name="nama">
				</div>
				<div class="form-group">
					<label for="tanggal_pemesanan">Tanggal Pemesanan</label>
					<input type="text" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan">
				</div>
				<div class="form-group">
					<label for="tanggal_selesai">Tanggal Selesai</label>
					<input type="text" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
				</div>
				<div class="form-group">
					<label for="deskripsi">Deskripsi</label>
					<textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
				</div>
				<div class="form-group">
					<label class="col-md-12 row" for="spesifikasi">Spesifikasi</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="spesifikasi">
							<option>Pilih Spesifikasi</option>
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
								<option>Pilih Kain</option>
								<?php
									$sql = " SELECT * from kains";
									$result = mysql_query($sql);
									while($row = mysql_fetch_row($result)) {
										echo "<option value='$row[0]'>".$row[1]."</option>";
									}
								?>
						</select>
					</div>
					
					<div class="clearfix"></div>
				</div>

				<div id="jenis_warna" class="form-group hide">
					<label class="col-md-12 row" for="warna">Warna</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="warna"></select>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary tambah_warna">Tambah</button>
					</div>
					<div class="clearfix"></div>
				</div>



				<div class="form-group">
					<label class="col-md-12 row" for="size">Size</label>

					<div class="col-md-6 row"> 
						<select class="form-control " id="size">
								<option>Pilih Size</option>
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
			</tbody>		
		</table>

		<h2>Kain</h2>
		
		<table class="table table-hover" id="table_kain">
			<thead>
				<tr>
					<th>Item</th>
					<th class="col-md-4">Banyaknya</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
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
			</tbody>		
		</table> 
		<button class="btn btn-primary ">Submit</button>



	</div>

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
            el += ' <td><div class="col-md-9 row"><input type="text" placeholder="0" class="form-control input-spesifikasi" input-sm name="spesifikasi['+value+']"></div></td>';
            el += '<td><button type="button" class="btn btn-danger btn-sm hapus_spesifikasi">Hapus</button></td>'
            el += '</tr>';

            $('#table_spesifikasi').append(el);
        });

		$('.tambah_warna').on('click',function(e){
            e.preventDefault();

            var kain = $('#kain option:selected').text();
            var value =  $('#warna').val();
            var text = $('#warna option:selected').text();

            if(!value){
                alert("Pilih Jenis Warna!");
                return false;
            }

            var el = '';
            el += '<tr>';
            el += ' <td>('+kain+') '+text+'</td>';
            el += ' <td><div class="col-md-12 row"><input type="text" placeholder="0" class="form-control input-warna" input-sm name="warna['+value+']"></div></td>';
            el += '<td><button type="button" class="btn btn-danger btn-sm hapus_warna">Hapus</button></td>'
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
            el += ' <td><div class="col-md-9 row"><input type="text" placeholder="0" class="form-control input-size" input-sm name="size['+value+']"></div></td>';
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
        	if(!$('body').find('.input-warna').length){
        		alert("Tambahkan Jenis Warna!");
        		return false;
        	}
        	if(!$('body').find('.input-size').length){
        		alert("Tambahkan Size!");
        		return false;
        	}
        });
			
		$('#kain').on('change',function(){

			$.ajax({
				url: 'get_warna.php',
				data: { 'id_kain': $('#kain').val() },
				dataType : 'json',
				success: function(results){
					if(results.Status == 'OK'){
						$('#warna').empty();

						if(results.data){
							$('#warna').append('<option value="">Pilih Warna</option>');
							$.each(results.data, function(i, warna){
								$('#warna').append('<option value="'+warna['id_jenis_warna']+'">'+warna['warna']+'</option>');
							});	
						} else {
							$('#warna').append('<option value="">Warna kosong</option>');
						}

						$('#jenis_warna').removeClass('hide');
					} 
				}
			});
		});


    });
</script>

</body>
</html>