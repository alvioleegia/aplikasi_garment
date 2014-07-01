<?php $pageTitle = 'Laporan Penjualan'; $pageActive = 'penjualan'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Laporan
        <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Penjualan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	 <div class="row">
		<div class="col-xs-12">
			<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data terhapus.
	            </div>
            <?php endif; ?>
            <?php if(isset($_GET['r']) && $_GET['r'] == 2): ?>
				<div class="alert alert-success alert-dismissable">
	                <i class="fa fa-check"></i>
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <b>Success!</b> Data berhasil ditambahkan.
	            </div>
            <?php endif; ?>
		    <div class="box">
		        <div class="box-header">
		            <h3 class="box-title">Laporan Penjualan<b>
		            	<?php 
		            		if(isset($_GET['rekap'])){
		            			echo ucfirst($_GET['rekap']);
		            		} else {
		            			echo 'Tahunan';
		            		}
		            	?></b>
		            </h3>
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsive">
		        	<div class="form-group input-group">
	                    <div class="input-group-btn">
	                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Jenis Laporan <span class="fa fa-caret-down"></span></button>
	                        <ul class="dropdown-menu">
	                            <li><a href="?rekap=tahunan">Tahunan</a></li>
	                            <li><a href="?rekap=bulanan">Bulanan</a></li>
	                            <li><a href="?rekap=mingguan">Mingguan</a></li>
	                        </ul>
	                    </div><!-- /btn-group -->
	                </div><!-- /input-group -->
		        	<div class="clearfix"></div>

		        	<?php if(!isset($_GET['rekap']) || isset($_GET['rekap']) && $_GET['rekap'] == 'tahunan' ): ?>
			            <table class="table table-hover" id="table_data">
			                <thead>
			                	<tr>
			                		<th>#</th>
				                    <th>Bulan</th>
				                    <th>Jumlah Produksi</th>
				                    <th>Uang Masuk</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php $total = 0; ?>
				                <?php for($i = 1; $i<=12; $i++): ?>
				                	<?php 
				                		$tahun = date("Y");
				                		//$tahun = $tahun ? $tahun : date("Y"); 
				                		$bulan = $i < 10 ? "0".$i : $i; 
				                		$start = $tahun."-".$bulan."-"."01"; 
				                		$end = $tahun."-".$bulan."-"."31";
				                	?>
				                	<tr>
				                		<td><?php echo $bulan; ?></td>
				                		<td><?php echo date('F', strtotime($start)); ?></td>
				                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
				                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
				                	</tr>
				                	<?php $total += laporanUangMasuk($start, $end); ?>
				                <?php endfor; ?>
				                <tr class="bg-gray">
				                	<td colspan="3" class="text-right"><b>Total</b></td>
				                	<td><b>Rp <?php echo getMoneyFormat($total); ?></b></td>
				                </tr>
			                </tbody>
			            </table>
			        <?php endif; ?>

			        <?php if(isset($_GET['rekap']) && $_GET['rekap'] == 'bulanan' ): ?>
			            <table class="table table-hover" id="table_data">
			                <thead>
			                	<tr>
			                		<th>#</th>
				                    <th>Minggu</th>
				                    <th>Jumlah Produksi</th>
				                    <th>Uang Masuk</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php $total = 0; ?>
			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."01"; 
			                		$end = $tahun."-".$bulan."-"."07";
			                	?>
			                	<tr>
			                		<td>1</td>
			                		<td>Satu</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."08"; 
			                		$end = $tahun."-".$bulan."-"."14";
			                	?>
			                	<tr>
			                		<td>2</td>
			                		<td>Dua</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."15"; 
			                		$end = $tahun."-".$bulan."-"."21";
			                	?>
			                	<tr>
			                		<td>3</td>
			                		<td>Tiga</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."22"; 
			                		$end = $tahun."-".$bulan."-"."28";
			                	?>
			                	<tr>
			                		<td>4</td>
			                		<td>Empat</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."29"; 
			                		$end = $tahun."-".$bulan."-"."35";
			                	?>
			                	<tr>
			                		<td>5</td>
			                		<td>Lima</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

				                <tr class="bg-gray">
				                	<td colspan="3" class="text-right"><b>Total</b></td>
				                	<td><b>Rp <?php echo getMoneyFormat($total); ?></b></td>
				                </tr>
			                </tbody>
			            </table>
			        <?php endif; ?>

			        <?php if(isset($_GET['rekap']) && $_GET['rekap'] == 'mingguan' ): ?>
			            <table class="table table-hover" id="table_data">
			                <thead>
			                	<tr>
			                		<th>#</th>
				                    <th>Hari</th>
				                    <th>Jumlah Produksi</th>
				                    <th>Uang Masuk</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php $total = 0; ?>
			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."01"; 
			                		$end = $tahun."-".$bulan."-"."07";
			                	?>
			                	<tr>
			                		<td>1</td>
			                		<td>Satu</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."08"; 
			                		$end = $tahun."-".$bulan."-"."14";
			                	?>
			                	<tr>
			                		<td>2</td>
			                		<td>Dua</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."15"; 
			                		$end = $tahun."-".$bulan."-"."21";
			                	?>
			                	<tr>
			                		<td>3</td>
			                		<td>Tiga</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."22"; 
			                		$end = $tahun."-".$bulan."-"."28";
			                	?>
			                	<tr>
			                		<td>4</td>
			                		<td>Empat</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

			                	<?php 
			                		$tahun = date("Y");
			                		$bulan = date("m");
			                		$start = $tahun."-".$bulan."-"."29"; 
			                		$end = $tahun."-".$bulan."-"."35";
			                	?>
			                	<tr>
			                		<td>5</td>
			                		<td>Lima</td>
			                		<td><?php echo getMoneyFormat(laporanJumlahProduksi($start, $end)); ?></td>
			                		<td>Rp <?php echo getMoneyFormat(laporanUangMasuk($start, $end)); ?></td>
			                	</tr>
			                	<?php $total += laporanUangMasuk($start, $end); ?>

				                <tr class="bg-gray">
				                	<td colspan="3" class="text-right"><b>Total</b></td>
				                	<td><b>Rp <?php echo getMoneyFormat($total); ?></b></td>
				                </tr>
			                </tbody>
			            </table>
			        <?php endif; ?>

		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<script type="text/javascript">
    // $(function() {
    //     $("#table_data").dataTable();
    // });
</script>

<?php include '../footer.php'; ?>