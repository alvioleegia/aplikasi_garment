<?php $pageTitle = 'Tambah Warna'; $pageActive = 'warna'; ?>
<?php include '../header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Input
        <small>Warna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Warna</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<form id="form_input" role="form" action="proses_input.php" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Warna Kain Baru</h3>
					</div>
					<?php if(isset($_GET['r']) && $_GET['r'] == 1): ?>
						<div class="alert alert-success alert-dismissable">
			                <i class="fa fa-check"></i>
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                <b>Success!</b> Data berhasil ditambahkan.
			            </div>
		            <?php endif; ?>
					<div class="box-body">
						<div class="form-group">
							<label>Kain</label>
							<select class="form-control" name="fm[id_kain]">
								<?php $q = mysql_query("SELECT * FROM kains ORDER BY kain ASC"); ?>
								<?php while($row = mysql_fetch_array($q)): ?>
									<option value="<?php echo $row['id_kain']; ?>"><?php echo $row['kain']; ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Warna</label>
							<input type="text" class="form-control" name="fm[warna]" required>
						</div>

						<div class="form-group">
							<label>Harga</label>
							<input type="number" class="form-control" name="fm[harga]" required>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-warning">
					<div class="box-header">
						<h3 class="box-title">Action</h3>
					</div>
					<div class="box-body">
						<p>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</p>
						<p>
							<a id="simpan-tambah" type="submit" class="btn btn-warning">Simpan & Tambah</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>

</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
		$('#simpan-tambah').on("click",function(e){
			e.preventDefault();
			$('#form_input').attr('action','proses_input.php?ref=tambah').submit();
		});
	});
</script>

<?php include '../footer.php'; ?>