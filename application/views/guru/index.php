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
                    <!-- small card -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $absensi; ?></h3>

                            <p>Dokumen Absensi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/absensi'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $nilai; ?></h3>

                            <p>Penilaian</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/nsiswa'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
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
                    <!-- small card -->
                </div>
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
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $pkl; ?></h3>

                            <p>Dokumen Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="<?= base_url($role['menu'] . '/doksiswa'); ?>" class="small-box-footer">
                            Lihat info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->