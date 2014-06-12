<?php $pageTitle = 'Edit Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>Produksi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Produksi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php if(isset($_GET['id'])){ ?>
    <?php
        $id = $_GET['id'];
        $sql = mysql_query("SELECT * FROM produksi WHERE id_produksi=$id");
        $data = mysql_fetch_array($sql);
    ?>
	<form role="form" action="proses_edit.php" method="post" id="form_input">
		<div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Biaya</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="box-body">
                         <?php
                            // Menghitung jumlah potong barang
                            $jml_pesanan = 0;
                            $sql = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id);

                            if($sql){
                                while($row = mysql_fetch_row($sql)) {
                                    $jml_pesanan += $row[3];
                                }
                            }
                            //echo $jml_pesanan;

                            // Menghitung harga kain/potong
                            $total_harga_kain = 0;
                            $sql = mysql_query("SELECT * FROM produksi_warna where id_produksi=".$id);
                            if($sql){
                                while($row = mysql_fetch_row($sql)) {
                                    $sql_warna = mysql_query("SELECT * FROM jenis_warna WHERE id_jenis_warna=".$row[3]);
                                    if ($sql_warna) {
                                        $warna = mysql_fetch_array($sql_warna) or die(mysql_error());

                                        //echo $warna['warna'].' '.($warna['harga'] * ($row[4]/100)).'<br>';
                                        $total_harga_kain += $warna['harga'] * ($row[4]/100);
                                    }
                                }
                            }
                            //echo $total_harga_kain;

                            // Menghitung harga spesifikasi
                            $total_harga_spesifikasi = 0;
                            $sql = mysql_query("SELECT * FROM produksi_spesifikasi where id_produksi=".$id);
                            if($sql){
                                while($row = mysql_fetch_row($sql)) {
                                    $sql_spesifikasii = mysql_query("SELECT * FROM sub_spesifikasi WHERE id_sub_spesifikasi=".$row[3]);
                                    if ($sql_spesifikasii) {
                                        $spesifikasi = mysql_fetch_array($sql_spesifikasii) or die(mysql_error());

                                        //echo $spesifikasi['nama'].' '.($spesifikasi['harga'] * $jml_pesanan).'<br>';
                                        $total_harga_spesifikasi += $spesifikasi['harga'] * $jml_pesanan;
                                    }
                                }
                            }
                            //echo $total_harga_spesifikasi;

                            $jenis_barang = dataJenisBarang($data['id_jenis_barang']);
                            $qty_per_kg = $jenis_barang['qty_per_kg'];
                            $harga_jasa = $jenis_barang['harga_jasa'];

                            // echo $qty_per_kg;
                            // echo $harga_jasa;

                            // Menghitung total harga
                            $lusin = ceil($jml_pesanan / 12);

                            if(!$total_harga_kain){
                                $harga_bersih = 0;
                            } else {
                                $harga_bersih = ((($jml_pesanan / $qty_per_kg) * $total_harga_kain) + $total_harga_spesifikasi + ($harga_jasa * $lusin));  
                            }

                            $fee_perusahaan = $harga_bersih * (30/100);

                            $total_harga = $harga_bersih + $fee_perusahaan;

                        ?>

                        <?php $i = 1; ?>
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Item</th>
                                <th style="width: 135px">Jumlah/Pemakaian</th>
                                <th>Harga</th>
                            </tr>

                            <?php $sql = mysql_query("SELECT * FROM produksi_warna WHERE id_produksi=".$data['id_produksi']); ?>
                            <?php while($row = mysql_fetch_array($sql)): ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td>Kain <?php echo getKain($row['id_kain']);?> <?php echo getWarna($row['id_jenis_warna']); ?> (<?php echo getHargaWarna($row['id_jenis_warna']); ?>/kg)</td>
                                    <td><?php echo $row['pemakaian']; ?>%</td>
                                    <td>Rp <?php echo getMoneyFormat((getHargaWarna($row['id_jenis_warna']) * $row['pemakaian'] / 100)); ?></td>
                                </tr>
                            <?php $i++; ?>
                            <?php endwhile; ?>

                            <tr >
                                <td colspan="2" class="text-right">
                                    <b>Total harga kain</b>
                                </td>
                                <td>1 kg</b></td>
                                <td><b>Rp <?php echo getMoneyFormat($total_harga_kain); ?></b></td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="2" class="text-right">
                                    <b>Total harga <?php echo $jenis_barang['barang']; ?> (<?php echo $qty_per_kg; ?> potong/kg)</b>
                                </td>
                                <td><b><?php echo ($jml_pesanan / $qty_per_kg); ?> kg</b></td>
                                <td><b>Rp <?php echo getMoneyFormat((($jml_pesanan / $qty_per_kg) * $total_harga_kain)); ?></b></td>
                            </tr>

                            <?php $sql = mysql_query("SELECT * FROM produksi_spesifikasi WHERE id_produksi=".$data['id_produksi']); ?>
                            <?php while($row = mysql_fetch_array($sql)): ?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td>
                                        <?php echo getSpesifikasi($row['id_spesifikasi']); ?> <?php echo getSubSpesifikasi($row['id_sub_spesifikasi']); ?> (<?php echo getMoneyFormat(getHargaSubSpesifikasi($row['id_sub_spesifikasi'])); ?>)
                                    </td>
                                    <td><?php echo $jml_pesanan; ?></td>
                                    <td>Rp <?php echo getMoneyFormat((getHargaSubSpesifikasi($row['id_sub_spesifikasi']) * $jml_pesanan)); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endwhile; ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>Fee Jasa (<?php echo getMoneyFormat($harga_jasa); ?>/lusin)</td>
                                <td><?php echo $lusin; ?></td>
                                <td>Rp <?php echo getMoneyFormat(($harga_jasa * $lusin)); ?></td>
                            </tr>
                            
                            <tr>
                                <td colspan="3" class="text-right">
                                    <b>Harga Bersih</b>
                                </td>
                                <td><b>Rp <?php echo getMoneyFormat($harga_bersih); ?></b></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-right">
                                    <b>Fee Perusahaan (30%)</b>
                                </td>
                                <td><b>Rp <?php echo getMoneyFormat($fee_perusahaan); ?></b></td>
                            </tr>

                            <tr class="bg-gray">
                                <td colspan="3" class="text-right">
                                    <b>Total Harga</b>
                                </td>
                                <td><b>Rp <?php echo getMoneyFormat($total_harga); ?></b></td>
                            </tr>
                        </table>

                        <div class="text-right margin">
                            <a class="btn btn-warning"><i class="fa fa-print"></i> Buat Nota</a>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Produksi #<?php echo $data['id_produksi']; ?></h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Nama Pemesan</label>
							<input type="text" class="form-control" name="fm[nama]" value="<?php echo $data['nama']; ?>" required>
						</div>

						<div class="form-group">
							<label>Tanggal Pemesanan</label>
							<div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="fm[tanggal_pemesanan]" id="tanggal_pemesanan" value="<?php echo $data['tanggal_pemesanan']; ?>" required/>
                            </div><!-- /.input group -->
						</div>

						<div class="form-group">
							<label>Tanggal Selesai</label>
							<div class="input-group">
								<div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
								<input type="text" class="form-control pull-right" name="fm[tanggal_selesai]" id="tanggal_selesai" value="<?php echo $data['tanggal_selesai']; ?>" required>
							</div>
						</div>

						<div class="form-group">
							<label>Jenis Barang</label>
							<select name="fm[id_jenis_barang]" class="form-control " id="jenis_barang" required>
								<?php $sql = mysql_query("SELECT * FROM jenis_barang ORDER BY barang ASC"); ?>
								<?php while($row = mysql_fetch_row($sql)): ?>
									<option value="<?php echo $row[0]; ?>" <?php if($row[0] == $data['id_jenis_barang']) echo 'selected'; ?> ><?php echo $row[1]; ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Deskripsi</label>
							<textarea id="deskripsi" name="fm[deskripsi]" style="width:100%;height:100px"><?php echo $data['deskripsi']; ?></textarea>
						</div>

                        <input type="hidden" name="fm[id_produksi]" value="<?php echo $data['id_produksi']; ?>">
					</div>
				</div>

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
                                <th style="width: 10px">#</th>
                                <th>Spesifikasi</th>
                                <th>Sub</th>
                                <th style="width: 20px">&nbsp;</th>
                            </tr>

                            <?php $sql = mysql_query("SELECT * FROM produksi_spesifikasi WHERE id_produksi=".$data['id_produksi']); ?>
                            <?php $i = 1; ?>
                            <?php while($row = mysql_fetch_array($sql)): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo getSpesifikasi($row['id_spesifikasi']); ?></td>
                                    <td><?php echo getSubSpesifikasi($row['id_sub_spesifikasi']); ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-xs hapus-spesifikasi">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </td>
                                    <input type="hidden" class="input-spesifikasi" name="spesifikasi[<?php echo $row['id_spesifikasi']; ?>]" value="<?php echo $row['id_sub_spesifikasi']; ?>">
                                </tr>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        </table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Action</h3>
					</div>
					<div class="box-body">
						<p>
							<button type="submit" class="btn btn-primary">Simpan</button>

                            <a class="btn btn-warning"><i class="fa fa-repeat"></i> Re-kalkulasi</a>
						</p>
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
								<?php while($row = mysql_fetch_row($sql)): ?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
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
                                <th style="width: 100px">Pemakaian</th>
                                <th style="width: 20px">&nbsp;</th>
                            </tr>
                            <?php $sql = mysql_query("SELECT * FROM produksi_warna WHERE id_produksi=".$data['id_produksi']); ?>
                            <?php $i = 1; ?>
                            <?php while($row = mysql_fetch_array($sql)): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo getKain($row['id_kain']); ?></td>
                                    <td><?php echo getWarna($row['id_jenis_warna']); ?></td>
                                    <td>
                                    <div class="input-group input-group-sm">
                                         <input type="text" class="form-control input-kain" value="<?php echo $row['pemakaian']; ?>" style="width:60px" name="warna[<?php echo $row['id_kain']; ?>][<?php echo $row['id_jenis_warna']; ?>]">
                                         <span class="input-group-btn">%</span>
                                     </div>
                                   </td>
                                    <td>
                                     <a class="btn btn-danger btn-xs hapus-kain">
                                         <i class="glyphicon glyphicon-remove"></i>
                                     </a>
                                    </td>
                                </tr>
                            <?php $i++; ?>
                            <?php endwhile; ?>
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
								<?php while($row = mysql_fetch_row($sql)): ?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
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

                            <?php $i = 1; ?>
                            <?php $sql = mysql_query("SELECT * FROM produksi_size WHERE id_produksi=".$data['id_produksi']); ?>
                            <?php while($row = mysql_fetch_array($sql)): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo getSize($row['id_size']); ?></td>
                                    <td>
                                     <div class="input-group input-group-sm">
                                         <input type="text" class="form-control input-size" style="width:60px" value="<?php echo $row['jumlah']; ?>" name="size[<?php echo $row['id_size']; ?>]">
                                     </div>
                                    </td>
                                    <td><a class="btn btn-danger btn-xs hapus-size" ><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                            <?php $i++; ?>
                            <?php endwhile; ?>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</form>
    <?php } else { ?>
        <?php include '../404.php'; ?>
    <?php } ?>

</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
		$('#tanggal_pemesanan, #tanggal_selesai').daterangepicker({singleDatePicker: true, format: 'YYYY-MM-DD'});
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
            el += '    <td>';
            el += '    	<div class="input-group input-group-sm">';
            el += '    		<input type="text" class="form-control input-kain" style="width:60px" name="warna['+kain_value+']['+value+']">';
            el += '    		<span class="input-group-btn">%</span>';
            el += '    	</div>';
            el += '   </td>';
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
        	}
        	if(!$('body').find('.input-size').length){
        		alert("Tambahkan Size!");
        		return false;
        	}
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