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
                <!-- Default box -->
                <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
                    <div class="card card-primary card-outline">
                        <!-- form start -->
                        <form class="form-group" action="<?= base_url($role['menu'] . '/editpel/' . $detail['id_pel']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group row">
                                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm" id="kelas" name="kelas">
                                                    <?php foreach ($kelas as $row) { ?>
                                                        <option value="<?= $row['id_kelas']; ?>" <?= $detail['kelas_id'] == $row['id_kelas'] ? 'selected' : ''; ?>>
                                                            <?= $row['kelas']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jurusan" class="col-sm-4 col-form-label">Jurusan</label>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm" id="jurusan" name="jurusan">
                                                    <?php foreach ($jurusan as $row) { ?>
                                                        <option value="<?= $row['id_jurusan']; ?>" <?= $detail['jurusan_id'] == $row['id_jurusan'] ? 'selected' : ''; ?>>
                                                            <?= $row['jurusan']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm" id="mapel" name="mapel">
                                                    <?php foreach ($mapel as $row) { ?>
                                                        <option value="<?= $row['id_mapel']; ?>" <?= $detail['mapel_id'] == $row['id_mapel'] ? 'selected' : ''; ?>>
                                                            <?= $row['mapel']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="file" class="col-sm-4 col-form-label">File</label>
                                            <div class="col-sm">
                                                <div class="custom-file">
                                                    <input type="hidden" name="old_file" value="<?= $detail['file']; ?>">
                                                    <input type="file" class="custom-file-input <?= form_error('file') == true || $this->session->flashdata('file') ? 'is-invalid' : ''; ?>" id="file" name="file">
                                                    <label class="custom-file-label" for="file">Pilih file</label>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('file'); ?>
                                                        <?= $this->session->flashdata('file'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ml-5">
                                            <label for="pegawai" class="col-sm-3 col-form-label">Diunggah oleh</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" value="<?= $user['name']; ?>" disabled>
                                                <input type="hidden" name="pegawai" value="<?= $user['id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url($role['menu'] . '/pelajaran'); ?>" type="button" class="btn btn-default">Batal</a>
                                <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
                            </div>

                        </form>
                        <!-- /.card-footer -->
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