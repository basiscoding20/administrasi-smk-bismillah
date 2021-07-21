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
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/profile/') . $detail['image']; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $detail['name']; ?></h3>

                            <p class="text-muted text-center"><?= $detail['role']; ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>NIP</b>
                                    <p class="float-right mb-1"><?= $detail['id']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <p class="float-right mb-1"><?= $detail['email']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>No. Hp</b>
                                    <p class="float-right mb-1"><?= $detail['no_hp']; ?></p>
                                </li>
                            </ul>
                            <?php if ($user['role_id'] == "1" || $user['role_id'] == "2") { ?>
                                <a href="<?= base_url($role['menu'] . '/editp/' . $detail['id'] . '/' . $loc); ?>" class="btn btn-primary btn-block">
                                    <i class="fas fa-pen"></i>
                                    <b>Ubah Profile</b>
                                </a>
                            <?php } ?>
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
                                        <?= $detail['tempat_lahir'] . ', ' . $detail['tgl_lahir']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Jenis Kelamin</b>
                                        <?= $detail['jenis_kelamin']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Pendidikan Terakhir</b>
                                        <?= $detail['pendidikan_terakhir']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Status</b>
                                        <?= $detail['status']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Jalan</b>
                                        <?= $detail['jalan']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Desa/Kelurahan</b>
                                        <?= $detail['desa_kelurahan']; ?>
                                    </p>
                                </div>
                                <div class="col col-md-6 text-muted">
                                    <p class="text-sm">
                                        <b class="d-block">Kecamatan</b>
                                        <?= $detail['kecamatan']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Kab/Kota</b>
                                        <?= $detail['kab_kota']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Provinsi</b>
                                        <?= $detail['provinsi']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Kode Pos</b>
                                        <?= $detail['kode_pos']; ?>
                                    </p>
                                    <p class="text-sm">
                                        <b class="d-block">Tahun Masuk</b>
                                        <?= $detail['tahun_masuk']; ?>
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
            <div class="row">
                <div class="col-12 col-md-12 col-lg-3 float-right">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md text-muted">
                                    <h5> <b>Dokumen Tenaga Kepegawaian</b> </h5>
                                    <?= $this->session->flashdata('message'); ?>
                                    <ul class="list-unstyled">
                                        <?php foreach ($dok as $d) : ?>
                                            <li>
                                                <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) : ?>
                                                    <a type="button" class="btn btn-xs" data-toggle="modal" data-target="#editDocModal<?= $d['id_tk']; ?>">
                                                        <i class="fas fa-pen fa-sm text-primary"></i>
                                                    </a>

                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/deldoktk/' . $d['id_tk'] . '/' . $detail['id']); ?>')" href="#!" type="button" class="btn btn-xs">
                                                        <i class="fas fa-trash fa-sm text-danger"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?= base_url('assets/dist/upload/kepegawaian/' . $d['file']); ?>" class="btn-link text-secondary" target="_blank">
                                                    <i class="fas fa-fw fa-file-alt"></i>
                                                    <?= $d['judul']; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) : ?>
                                        <a type="button" class="btn btn-primary btn-xs col" data-toggle="modal" data-target="#addDocModal">
                                            <i class="fas fa-plus fa-xs"></i>
                                            Tambah Dokumen
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="addDocModal" tabindex="-1" role="dialog" aria-labelledby="addDocModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocModalLabel">Unggah Dokumen</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url($role['menu'] . '/adddoktk/' . $detail['id']); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul Dokumen</label>
                        <div class="col-sm">
                            <input type="hidden" name="pegawai" value="<?= $detail['id']; ?>">
                            <input type="text" class="form-control form-control-sm" name="judul" id="judul" placeholder="Judul Dokumen" required>
                            <div class="invalid-feedback">
                                <?= form_error('judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-3 col-form-label">Dokumen</label>
                        <div class="col-sm">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" required>
                                <label class="custom-file-label" for="file">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($dok as $row) : ?>
    <div class="modal fade" id="editDocModal<?= $row['id_tk']; ?>" tabindex="-1" role="dialog" aria-labelledby="editDocModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDocModalLabel">Unggah Dokumen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url($role['menu'] . '/editdoktk/' . $row['id_tk'] . '/' . $detail['id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="judul" class="col-sm-3 col-form-label">Judul Dokumen</label>
                            <div class="col-sm">
                                <input type="hidden" name="pegawai" value="<?= $detail['id']; ?>">
                                <input type="text" class="form-control form-control-sm" name="judul" id="judul" placeholder="Judul Dokumen" value="<?= $row['judul']; ?>" required>
                                <div class="invalid-feedback">
                                    <?= form_error('judul'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-sm-3 col-form-label">Dokumen</label>
                            <div class="col-sm">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>