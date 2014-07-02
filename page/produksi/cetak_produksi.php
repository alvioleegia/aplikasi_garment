<?php $pageTitle = 'Cetak Surat Perintah Produksi'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>      

<style type="text/css">
    @media print {
      @page 
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm;  /* this affects the margin in the printer settings */
          size: potrait;
      }
    }
</style>

<?php if(isset($_GET['id'])): ?>
    <?php
        $id = $_GET['id'];
        $sql = mysql_query("SELECT * FROM produksi WHERE id_produksi=$id");
        $data = mysql_fetch_array($sql);
    ?>
<?php endif; ?>

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

    $harga_satuan = $total_harga / $jml_pesanan;

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Produksi
        <small>#<?php echo $data['kode_produksi']; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content invoice">                    
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header text-center">
               SURAT PERINTAH PRODUKSI
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-xs-3 ">
            <b>Pemesan:</b><br><?php echo $data['nama']; ?>
        </div>
        <div class="col-xs-3 ">
            <b>Tgl. Pesan:</b><br><?php echo dateFormat($data['tanggal_pemesanan']); ?>
        </div>
        <div class="col-xs-3 ">
            <b>Tgl. Selesai:</b><br><?php echo dateFormat($data['tanggal_selesai']); ?>
        </div>
        <div class="col-xs-3 ">
            <b>No. Produksi:</b><br><?php echo $data['kode_produksi']; ?>
        </div>
    </div><!-- /.row -->
    <div class="clearfix margin"></div>
    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive" >
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" colspan="4">TABEL PRODUKSI</th>
                    </tr>                                    
                </thead>
                <tbody>
                    <td style="width:50%">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:50%"><b>Jenis Barang</b></td>
                                    <td style="width:55%"><?php echo getJenisBarang($data['id_jenis_barang']); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th >Kain</th>
                                    <th style="width:25%">Pemakaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sql = mysql_query("SELECT * FROM produksi_warna WHERE id_produksi=".$data['id_produksi']); ?>
                                <?php while($row = mysql_fetch_array($sql)): ?>
                                    <tr>
                                        <td>Kain <?php echo getKain($row['id_kain']);?> <?php echo getWarna($row['id_jenis_warna']); ?></td>
                                        <td><?php echo $row['pemakaian']; ?>%</td>
                                    </tr>
                                <?php $i++; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:25%">Ukuran</th>
                                    <?php $q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id); ?>
                                    <?php while($row = mysql_fetch_array($q)): ?>
                                        <th><?php echo getSize($row['id_size']); ?></th>              
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Jumlah</b></td>
                                    <?php $q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id); ?>
                                    <?php while($row = mysql_fetch_array($q)): ?>
                                        <td><?php echo $row['jumlah']; ?></td>
                                    <?php endwhile; ?>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><?php echo $jml_pesanan; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered no-margin">
                            <thead>
                                <tr>
                                    <th>Deskripsi/keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $data['deskripsi']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width:50%" colspan="2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Spesifikasi</th>
                                    <th style="width:25%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $sql = mysql_query("SELECT * FROM produksi_spesifikasi WHERE id_produksi=".$data['id_produksi']); ?>
                                <?php while($row = mysql_fetch_array($sql)): ?>
                                    <tr>
                                        <td>
                                            <?php echo getSpesifikasi($row['id_spesifikasi']); ?> <?php echo getSubSpesifikasi($row['id_sub_spesifikasi']); ?> (<?php echo getMoneyFormat(getHargaSubSpesifikasi($row['id_sub_spesifikasi'])); ?>)
                                        </td>
                                        <td><?php echo $jml_pesanan; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <table class="table table-bordered no-margin">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <img style="max-height:200px" src="<?php echo DOMAIN; ?>/images/produksi/<?php echo $data['gambar']; ?>">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tbody>
            </table>
        </div>
    </div><!-- /.row -->

    <div class="page-break"></div>

    <div class="row hide tabel-pengawasan">
        <div class="col-xs-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" colspan="4">TABEL PENGAWASAN PRODUKSI</th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table class="table table-bordered no-margin">
                                <thead>
                                    <tr>
                                        <th style="width:15%">Tgl. Mulai</th>
                                        <th style="width:45%">Proses</th>
                                        <th style="width:40%">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>&nbsp;<br>&nbsp;<br>&nbsp;</td>
                                        <td></td>
                                        <td></td> 
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>                            
        </div><!-- /.col -->
    </div>

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-warning" onclick="window.print();"><i class="fa fa-print"></i> Print</button> 
        </div>
    </div>
</section><!-- /.content -->
<?php include '../footer.php'; ?>