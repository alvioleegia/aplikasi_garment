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
		            <h3 class="box-title">Laporan Penjualan</h3>
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsive">
		        	<div class="form-group input-group">
	                    <div class="input-group-btn">
	                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Jenis Laporan <span class="fa fa-caret-down"></span></button>
	                        <ul class="dropdown-menu">
	                            <li><a href="?rekap=tahunan">Tahunan</a></li>
	                            <li><a href="?rekap=bulanan">Bulanan</a></li>
	                            <li><a href="?rekap=harian">Harian</a></li>
	                            <li class="divider"></li>
	                            <li><a href="#">Semua</a></li>
	                        </ul>
	                    </div><!-- /btn-group -->
	                </div><!-- /input-group -->
		        	<div class="clearfix"></div>

		        	<?php if(isset($_GET['rekap']) /*&& $_GET['rekap'] == 'tahunan'*/ ): ?>
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
				                <?php for($i = 1; $i<=12; $i++): ?>
				                	<?php 
				                		$tahun = $tahun ? $tahun : date("Y"); 
				                		$bulan = $i < 10 ? "0".$i : $i; 
				                		$start = $tahun."-".$bulan."-"."01"; 
				                		$end = $tahun."-".$bulan."-"."31";
				                	?>
				                	<tr>
				                		<td><?php echo $bulan; ?></td>
				                		<td><?php echo date('F', strtotime($first_condition)); ?></td>
				                		<td><?php echo laporanJumlahProduksi($start, $end); ?></td>
				                		<td><?php echo laporanUangMasuk($start, $end); ?></td>
				                	</tr>
				                <?php endfor; ?>
			                </tbody>
			            </table>
			        <?php endif; ?>

		        </div><!-- /.box-body -->
		    </div><!-- /.box -->
		</div>
		</div>
</section><!-- /.content -->

<script type="text/javascript">
    $(function() {
        $("#table_data").dataTable();
    });
</script>

<?php include '../footer.php'; ?>