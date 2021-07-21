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
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $inbox; ?></h3>
                            <p>Surat Masuk
                                <?php if ($newinbox) : ?>
                                    <span class="badge bg-danger"><?= $newinbox; ?></span>
                                <?PHP endif; ?>
                            </p>

                        </div>
                        <div class="icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/inbox'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $outbox; ?></h3>
                            <p>Surat Keluar
                                <?php if ($newoutbox) : ?>
                                    <span class="badge bg-danger"><?= $newoutbox; ?></span>
                                <?PHP endif; ?>
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/outbox'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="row mt-5">
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $lpj; ?></h3>
                            <p>Dokumen LPJ</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/lpj'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $pelajaran; ?></h3>
                            <p>Dokumen Pelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/pelajaran'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3><?= $silabus; ?></h3>
                            <p>Dokumen Silabus</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/silabus'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $absensi; ?></h3>
                            <p>Dokumen Absensi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/absensi'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $siswa; ?></h3>

                            <p>Data Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/datasiswa'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $guru; ?></h3>
                            <p>Data Guru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/guru'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3><?= $pkl; ?></h3>
                            <p>Dokumen Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-paste"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/doksiswa'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
                <!-- small card -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $arsip; ?></h3>
                            <p>Laporan Buku Arsip</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/arsip'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->