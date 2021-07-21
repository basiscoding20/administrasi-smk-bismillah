<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $pelajaran; ?></h3>

                            <p>Dokumen Pelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="<?= base_url('kurikulum/pelajaran'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    <!-- small card -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $lpj; ?></h3>

                            <p>Dokumen LPJ</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="<?= base_url('kurikulum/lpj'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $inbox; ?></h3>

                            <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <a href="<?= base_url('kurikulum/inbox'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </ </div> </div> <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->