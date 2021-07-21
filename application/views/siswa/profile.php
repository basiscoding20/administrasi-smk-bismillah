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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/profile/') . $user['image']; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $user['name']; ?></h3>

                            <p class="text-muted text-center"><?= $user['id']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tahun Masuk</b>
                                    <p class="float-right mb-1"><?= $user['tahun_masuk']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Kelamin</b>
                                    <p class="float-right mb-1"><?= $user['jenis_kelamin']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>No. Hp</b>
                                    <p class="float-right mb-1"><?= $user['no_hp']; ?></p>
                                </li>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block">
                                <i class="fas fa-pen"></i>
                                <b>Ubah Profile</b>
                            </a> -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Default box -->
                <div class="col-12 col-md-12 col-lg-9 order-1 order-md-2">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-6 text-muted">
                                    <p class="text-sm">
                                        <b class="d-block">Tempat, Tanggal Lahir</b>
                                        <?= $user['tempat_lahir'] . ', ' . $user['tgl_lahir']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Alamat</b>
                                        <?= $user['alamat']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Anak ke-</b>
                                        <?= $user['anak_ke'] . ' dari ' . $user['dari'] . ' bersaudara'; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Nama Ayah</b>
                                        <?= $user['nama_ayah']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">No. Hp Ayah</b>
                                        <?= $user['no_hp_ayah']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Pekerjaan Ayah</b>
                                        <?= $user['pekerjaan_ayah']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Nama Ibu</b>
                                        <?= $user['nama_ibu']; ?>
                                    </p>
                                </div>
                                <div class="col col-md-3 text-muted">
                                    <p class="text-sm">
                                        <b class="d-block">No. Hp Ibu</b>
                                        <?= $user['no_hp_ibu']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Pekerjaan Ibu</b>
                                        <?= $user['pekerjaan_ibu']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Alamat Orang Tua</b>
                                        <?= $user['alamat_orangtua']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Nama Wali</b>
                                        <?= $user['nama_wali']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">No. Hp Wali</b>
                                        <?= $user['no_hp_wali']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Pekerjaan Wali</b>
                                        <?= $user['pekerjaan_wali']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Alamat Wali</b>
                                        <?= $user['alamat_wali']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card -->


        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->