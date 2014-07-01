<?php $pageTitle = 'PT Cipta Gemilang Sentosa'; $pageActive = 'dashboard'; ?>
<?php include 'header.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>
                        <?php echo getCountProduksi(0); ?>
                    </h3>
                    <p>
                        Pending
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-copy"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=0" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo getCountProduksi(2); ?>
                    </h3>
                    <p>
                        Ready
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=2" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>
                        <?php echo getCountProduksi(3); ?>
                    </h3>
                    <p>
                        Uang muka
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=3" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>
                         <?php echo getCountProduksi(4); ?>
                    </h3>
                    <p>
                        Produksi
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=4" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>
                         <?php echo getCountProduksi(5); ?>
                    </h3>
                    <p>
                        Pelunasan
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=5" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo getCountProduksi(6); ?>
                    </h3>
                    <p>
                        Selesai
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=6" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php echo getCountProduksi(1); ?>
                    </h3>
                    <p>
                        Cancel
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-minus-circle"></i>
                </div>
                <a href="<?php echo DOMAIN; ?>/page/produksi/index.php?status=1" class="small-box-footer">
                    Lihat data <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->

</section><!-- /.content -->

<?php include 'footer.php'; ?>