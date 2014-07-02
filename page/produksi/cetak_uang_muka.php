<?php $pageTitle = 'Cetak Nota Uang Muka'; $pageActive = 'produksi'; ?>
<?php include '../header.php'; ?>      

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
        Invoice
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
            <h2 class="page-header">
                <img src="<?php echo DOMAIN; ?>/img/logo_2.png" style="width:25px"> PT. Cipta Gemilang Sentosa
                <small class="pull-right"><?php echo date("d/M/Y"); ?></small>
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>
                Jl. Raya Banjaran KM. 15.5 No. 482<br>
                Bandung, 40376<br>
                Phone: (022) 8940685<br>
                Fax: (022) 5940136
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Kepada
            <address>
                <strong><?php echo $data['nama']; ?></strong><br>
                <?php echo $data['alamat']; ?><br>
                Phone: <?php echo $data['no_tlp']; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?php echo $data['kode_produksi']; ?></b><br/>
            <br/>
            <b>Tanggal Pesan:</b> <?php echo dateFormat($data['tanggal_pemesanan']); ?><br/>
            <b>Tanggal Selesai:</b> <?php echo dateFormat($data['tanggal_selesai']); ?>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Item</th>
                        <?php $q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id); ?>
                        <?php $jml_size = mysql_num_rows($q) + 2; ?>
                        <?php while($row = mysql_fetch_array($q)): ?>
                            <th><?php echo getSize($row['id_size']); ?></th>
                        <?php endwhile; ?>
                        <th style="width:12.5%">Harga</th>
                        <th style="width:15%">Subtotal</th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?php echo $jml_pesanan; ?></strong></td>
                        <td><strong><?php echo $jenis_barang['barang']; ?></strong></td>
                        <?php $q = mysql_query("SELECT * FROM produksi_size where id_produksi=".$id); ?>
                        <?php while($row = mysql_fetch_array($q)): ?>
                            <td><?php echo $row['jumlah']; ?></td>
                        <?php endwhile; ?>
                        <td><strong>Rp <?php echo getMoneyFormat($harga_satuan); ?></strong></td>
                        <td><strong>Rp <?php echo getMoneyFormat($total_harga); ?></strong></td>
                    </tr>

                    

                    <?php $q = mysql_query("SELECT * FROM produksi_warna where id_produksi=".$id); ?>
                    <?php while($row = mysql_fetch_array($q)): ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>- Kain <?php echo getKain($row['id_kain']); ?> <?php echo getWarna($row['id_jenis_warna']); ?></td>
                            <td colspan="<?php echo $jml_size; ?>">&nbsp;</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>                            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        
        <div class="col-xs-6 pull-right">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Total:</th>
                        <td>Rp <?php echo getMoneyFormat($total_harga); ?></td>
                    </tr>
                    <tr>
                        <?php $uang_muka = $total_harga * 0.4; ?>
                        <th>Uang Muka (40%):</th>
                        <td>Rp <?php echo getMoneyFormat($uang_muka); ?></td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->

        <div class="clearfix"></div>

        <!-- accepted payments column -->
        <div class="col-xs-3 col-xs-push-2">
            <p class="text-center"><b>Tanda Terima</b></p>
            <br><br><br>
            <p class="text-center">.........................................</p>
        </div><!-- /.col -->
        <div class="col-xs-3 col-xs-push-3">
            <p class="text-center"><b>Hormat Kami</b></p>
            <br><br><br>
            <p class="text-center">.........................................</p>
        </div><!-- /.col -->

    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-warning" onclick="window.print();"><i class="fa fa-print"></i> Print</button> 
        </div>
    </div>
</section><!-- /.content -->
<?php include '../footer.php'; ?>