<?php $pageTitle = 'Tambah Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Produksi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<form role="form" action="proses_input.php" method="post" id="form_input" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Produksi Baru</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Nama Pemesan</label>
							<input type="text" class="form-control" name="fm[nama]" required>
						</div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="fm[alamat]" class="form-control" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>No. Tlp</label>
                            <input type="text" class="form-control" name="fm[no_tlp]" required>
                        </div>

                        <?php if($_SESSION['level'] == 1): ?>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="fm[status]" class="form-control " id="jenis_barang" required>
                                    <option value="0">Pending</option>
                                    
                                    <option value="2">Ready</option>
                                    <option value="3">Uang muka</option>
                                    <option value="4">Produksi</option>
                                    <option value="5">Pelunasan</option>
                                    <option value="6">Lunas</option>
                                    
                                    <option value="7">Cancel</option>
                                </select>
                            </div>
                        <?php endif; ?>

						<div class="form-group">
							<label>Tanggal Pemesanan</label>
							<div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="fm[tanggal_pemesanan]" id="tanggal_pemesanan" required/>
                            </div><!-- /.input group -->
						</div>

						<div class="form-group">
							<label>Tanggal Selesai</label>
							<div class="input-group">
								<div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
								<input type="text" class="form-control pull-right" name="fm[tanggal_selesai]" id="tanggal_selesai" required/>
							</div>
						</div>

						<div class="form-group">
							<label>Jenis Barang</label>
							<select name="fm[id_jenis_barang]" class="form-control " id="jenis_barang" required>
                                <option value="">Pilih Barang</option>
								<?php $sql = mysql_query("SELECT * FROM jenis_barang ORDER BY barang ASC"); ?>
								<?php while($row = mysql_fetch_array($sql)): ?>
									<option value="<?php echo $row['id_jenis_barang']; ?>"><?php echo $row['barang']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Deskripsi</label>
							<textarea id="deskripsi" name="fm[deskripsi]" style="width:100%;height:100px"></textarea>
						</div>
					</div>
				</div>

                <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
    				<div class="box box-danger">
    					<div class="box-header">
    						<h3 class="box-title">Spesifikasi</h3>
    					</div>
    					<div class="box-body">
    						<div class="form-group">
    							<select class="form-control " id="tambah_spesifikasi">
    								<option>Pilih Spesifikasi</option>
    								<?php $sql = mysql_query("SELECT * FROM spesifikasis ORDER BY spesifikasi ASC"); ?>
    								<?php while($row = mysql_fetch_row($sql)): ?>
    									<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
    								<?php endwhile; ?>
    							</select>
    						</div>
    						<div class="input-group form-group hide" id="sub_spesifikasi">
    							<select class="form-control " id="pilih_sub_spesifikasi">
    								<option>Pilih Sub</option>
    							</select>
    							<span class="input-group-btn">
                                    <button class="btn btn-primary btn-flat" id="tambah_sub_spesifikasi" type="button">Tambah</button>
                                </span>
    						</div>

    						<table class="table table-striped" id="data_spesifikasi">
                                <tr>
                                    <th style="width: 10px">f</th>
                                    <th>Spesifikasi</th>
                                    <th>Sub</th>
                                    <th style="width: 20px">&nbsp;</th>
                                </tr>
                            </table>
    					</div>
    				</div>
                <?php endif; ?>
			</div>
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Action</h3>
					</div>
					<div class="box-body">
						<p>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</p>
					</div>
				</div>

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Gambar</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input type="file" name="fm[gambar]">
                        </div>
                    </div>
                </div>

				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Kain</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<select class="form-control " id="tambah_kain">
								<option>Pilih Kain</option>
								<?php $sql = mysql_query("SELECT * FROM kains ORDER BY kain ASC"); ?>
								<?php while($row = mysql_fetch_array($sql)): ?>
									<option value="<?php echo $row['id_kain']; ?>"><?php echo $row['kain']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="input-group form-group hide" id="warna">
							<select class="form-control " id="pilih_warna">
								<option>Pilih Warna</option>
							</select>
							<span class="input-group-btn">
                                <button class="btn btn-primary btn-flat" id="tambah_warna" type="button">Tambah</button>
                            </span>
						</div>

						<table class="table table-striped" id="data_kain">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Kain</th>
                                <th>Warna</th>
                                <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                                    <th style="width: 100px">Pemakaian</th>
                                <?php endif; ?>
                                <th style="width: 20px">&nbsp;</th>
                            </tr>
                        </table>
					</div>
				</div>

				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Size</h3>
					</div>
					<div class="box-body">
						<div class="input-group form-group">
							<select class="form-control " id="pilih_size">
								<option>Pilih Size</option>
								<?php $sql = mysql_query("SELECT * FROM sizes ORDER BY size ASC"); ?>
								<?php while($row = mysql_fetch_array($sql)): ?>
									<option value="<?php echo $row['id_size']; ?>"><?php echo $row['size']; ?></option>
								<?php endwhile; ?>
							</select>
							<span class="input-group-btn">
                                <button class="btn btn-primary btn-flat" id="tambah_size" type="button">Tambah</button>
                            </span>
						</div>

						<table class="table table-striped" id="data_size">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Size</th>
                                <th style="width:100px">Jumlah</th>
                                <th style="width: 20px">&nbsp;</th>
                            </tr>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</form>

</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
        $('#tanggal_pemesanan').daterangepicker({singleDatePicker: true, format: 'YYYY-MM-DD'});
		$('#tanggal_selesai').daterangepicker({singleDatePicker: true, format: 'YYYY-MM-DD'});
		$('#deskripsi').wysihtml5({ "font-styles" : false, "image" : false, "link" : false});

		$('#tambah_sub_spesifikasi').on('click',function(e){
            e.preventDefault();

            var spesifikasi_value = $('#tambah_spesifikasi').val();
            var spesifikasi = $('#tambah_spesifikasi option:selected').text();
            var value =  $('#pilih_sub_spesifikasi').val();
            var text = $('#pilih_sub_spesifikasi option:selected').text();

            if(!value){
                alert("Pilih Sub Spesifikasi!");
                return false;
            }

            var jumlah_spesifikasi = $('#data_spesifikasi').find('tr').length;

            var el = '';

            el += '<tr>';
        	el += '    <td>'+jumlah_spesifikasi+'.</td>';
            el += '    <td>'+spesifikasi+'</td>';
            el += '    <td>'+text+'</td>';
            el += '    <td><a class="btn btn-danger btn-xs hapus-spesifikasi"><i class="glyphicon glyphicon-remove"></i></a></td>';
            el += '    <input type="hidden" class="input-spesifikasi" name="spesifikasi['+spesifikasi_value+']" value="'+value+'">';
            el += '</tr>';

            $('#data_spesifikasi').append(el);
        });

		$('#tambah_warna').on('click',function(e){
            e.preventDefault();

            var kain_value = $('#tambah_kain').val();
            var kain = $('#tambah_kain option:selected').text();
            var value =  $('#pilih_warna').val();
            var text = $('#pilih_warna option:selected').text();

            if(!value){
                alert("Pilih Warna Kain!");
                return false;
            }

            var jumlah_kain = $('#data_kain').find('tr').length;

            var el = '';
            el += '<tr>';
            el += '    <td>'+jumlah_kain+'.</td>';
            el += '    <td>'+kain+'</td>';
            el += '    <td>'+text+'</td>';

            <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2){ ?>
                el += '    <td>';
                el += '    	<div class="input-group input-group-sm">';
                el += '    		<input type="text" class="form-control input-kain" style="width:60px" name="warna['+kain_value+']['+value+']">';
                el += '    		<span class="input-group-btn">%</span>';
                el += '    	</div>';
                el += '   </td>';
            <?php } else { ?>
                el += '         <input type="hidden" class="input-kain" name="warna['+kain_value+']['+value+']" value="0">';
            <?php } ?>

            el += '    <td>';
            el += '    	<a class="btn btn-danger btn-xs hapus-kain">';
            el += '    		<i class="glyphicon glyphicon-remove"></i>';
            el += '    	</a>';
            el += '    </td>';
            el += '</tr>';

            $('#data_kain').append(el);
        });

        $('#tambah_size').on('click',function(e){
            e.preventDefault();

            var value =  $('#pilih_size').val();
            var text = $('#pilih_size option:selected').text()
            if(!value){
                    alert("Pilih Size!");
                    return false;
            }

            var jumlah_size = $('#data_size').find('tr').length;

            var el = '';
			el += '<tr>';
            el += '    <td>'+jumlah_size+'.</td>';
            el += '    <td>'+text+'</td>';
            el += '    <td>';
            el += '    	<div class="input-group input-group-sm">';
            el += '    		<input type="text" class="form-control input-size" style="width:60px" name="size['+value+']">';
            el += '    	</div>';
            el += '    </td>';
            el += '    <td><a class="btn btn-danger btn-xs hapus-size" ><i class="glyphicon glyphicon-remove"></i></a></td>';
            el += '</tr>';

            $('#data_size').append(el);
        });
     
     	$('body').on('click','.hapus-spesifikasi',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
            	$(this).parents('tr').remove();

            	//reorder data
            	var s = 1;
            	$.each($('#data_spesifikasi').find('tr'), function(i, e){
            		if(i > 0){
            			$(e).find('td:first-child').text(s+'.');
            			s++;
            		}
            	});
            }
        });

     	$('body').on('click','.hapus-kain',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
            	$(this).parents('tr').remove();

            	//reorder data
            	var s = 1;
            	$.each($('#data_kain').find('tr'), function(i, e){
            		if(i > 0){
            			$(e).find('td:first-child').text(s+'.');
            			s++;
            		}
            	});
            }
        });

        $('body').on('click','.hapus-size',function(e){
     		e.preventDefault();
            var hapus = confirm("Hapus?");

            if(hapus){
            	$(this).parents('tr').remove();

            	//reorder data
            	var s = 1;
            	$.each($('#data_size').find('tr'), function(i, e){
            		if(i > 0){
            			$(e).find('td:first-child').text(s+'.');
            			s++;
            		}
            	});
            }
        });

        $('#form_input').submit(function(){
        	// if(!$('body').find('.input-spesifikasi').length){
        	// 	alert("Tambahkan Spesifikasi!");
        	// 	return false;
        	// }
        	if(!$('body').find('.input-kain').length){
        		alert("Tambahkan Kain!");
        		return false;
        	} <?php if($_SESSION['level'] == 1 || $_SESSION['level'] == 2){ ?> else if($('body').find('.input-kain').length){
                var jumlah_kain = 0;
                $.each($('body').find('.input-kain'),function(i, e){
                    jumlah_kain += parseInt($(e).val());
                });

                if(jumlah_kain < 100 || jumlah_kain > 100){
                    alert("Pemakaian kain harus 100%!");
                    return false;
                }
            }
            <?php } ?>

        	if(!$('body').find('.input-size').length){
        		alert("Tambahkan Size!");
        		return false;
        	}
        });

        $('#jenis_barang').on('change',function(){
            $.ajax({
                url: 'get_size.php',
                data: { 'id_jenis_barang': $('#jenis_barang').val() },
                dataType : 'json',
                success: function(results){
                    if(results.Status == 'OK'){
                        $('#pilih_size').empty();

                        if(results.data){
                            $('#pilih_size').append('<option value="">Pilih Size</option>');
                            $.each(results.data, function(i, size){
                                $('#pilih_size').append('<option value="'+size['id_size']+'">'+size['size']+'</option>');
                            }); 
                        } else {
                            $('#pilih_size').append('<option value="">Size kosong</option>');
                        }
                    } 
                }
            });
        });
			
		$('#tambah_kain').on('change',function(){
			$.ajax({
				url: 'get_warna.php',
				data: { 'id_kain': $('#tambah_kain').val() },
				dataType : 'json',
				success: function(results){
					if(results.Status == 'OK'){
						$('#pilih_warna').empty();

						if(results.data){
							$('#pilih_warna').append('<option value="">Pilih Warna</option>');
							$.each(results.data, function(i, warna){
								$('#pilih_warna').append('<option value="'+warna['id_jenis_warna']+'">'+warna['warna']+'</option>');
							});	
						} else {
							$('#pilih_warna').append('<option value="">Warna kosong</option>');
						}

						$('#warna').removeClass('hide');
					} 
				}
			});
		});

		$('#tambah_spesifikasi').on('change',function(){
			$.ajax({
				url: 'get_sub_spesifikasi.php',
				data: { 'id_spesifikasi': $('#tambah_spesifikasi').val() },
				dataType : 'json',
				success: function(results){
					if(results.Status == 'OK'){
						$('#pilih_sub_spesifikasi').empty();

						if(results.data){
							$('#pilih_sub_spesifikasi').append('<option value="">Pilih Sub</option>');
							$.each(results.data, function(i, sub){
								$('#pilih_sub_spesifikasi').append('<option value="'+sub['id_sub_spesifikasi']+'">'+sub['nama']+'</option>');
							});	
						} else {
							$('#pilih_sub_spesifikasi').append('<option value="">Warna kosong</option>');
						}

						$('#sub_spesifikasi').removeClass('hide');
					} 
				}
			});
		});
	})
</script>

<?php include '../footer.php'; ?>