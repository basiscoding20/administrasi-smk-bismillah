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
                        <form class="form-group" action="<?= base_url($role['menu'] . '/addnsiswa'); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group row">
                                            <label for="siswa" class="col-sm-4 col-form-label">Siswa</label>
                                            <div class="col-sm">
                                                <select class="form-control select2 form-control-sm col-sm-6" style="width: 100%;" id="siswa" name="siswa">
                                                    <?php foreach ($siswa as $row) { ?>
                                                        <option value="<?= $row['id']; ?>" <?= set_value('siswa') == $row['id'] ? 'selected' : ''; ?>>
                                                            <?= $row['id'] . ' - ' . $row['name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" form-group row">
                                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                                            <div class="col-sm-2">
                                                <select class="form-control form-control-sm" id="kelas" name="kelas">
                                                    <?php foreach ($kelas as $row) { ?>
                                                        <option value="<?= $row['id_kelas']; ?>" <?= set_value('kelas') == $row['id_kelas'] ? 'selected' : ''; ?>>
                                                            <?= $row['kelas']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm" name="jurusan">
                                                    <?php foreach ($jurusan as $row) { ?>
                                                        <option value="<?= $row['id_jurusan']; ?>" <?= set_value('jurusan') == $row['id_jurusan'] ? 'selected' : ''; ?>>
                                                            <?= $row['jurusan']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ta" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control form-control-sm <?= form_error('ta1') == true ? 'is-invalid' : ''; ?>" name="ta1" id="ta" value="<?= set_value('ta1'); ?>" placeholder="Tahun">
                                                <div class="invalid-feedback">
                                                    <?= form_error('ta1'); ?>
                                                </div>
                                            </div>
                                            <p>/</p>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control form-control-sm <?= form_error('ta2') == true ? 'is-invalid' : ''; ?>" name="ta2" value="<?= set_value('ta2'); ?>" placeholder="Tahun">
                                                <div class="invalid-feedback">
                                                    <?= form_error('ta2'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" form-group row">
                                            <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm col-sm-6" id="semester" name="semester">
                                                    <option value="Ganjil" <?= set_value('semester') == 'Ganjil' ? 'selected' : ''; ?>>
                                                        Ganjil
                                                    </option>
                                                    <option value="Genap" <?= set_value('semester') == 'Genap' ? 'selected' : ''; ?>>
                                                        Genap
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row ml-5">
                                            <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                            <div class="col-sm">
                                                <select class="form-control form-control-sm" id="mapel" name="mapel">
                                                    <?php foreach ($mapel as $row) { ?>
                                                        <option value="<?= $row['id_mapel']; ?>" <?= set_value('mapel') == $row['id_mapel'] ? 'selected' : ''; ?>>
                                                            <?= $row['mapel']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="latihan" class="col-sm-3 col-form-label">Nilai Latihan</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('latihan') == true ? 'is-invalid' : ''; ?>" name="latihan" id="latihan" value="<?= set_value('latihan'); ?>" placeholder="10 s/d 100">
                                                <div class="invalid-feedback">
                                                    <?= form_error('latihan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="tugas" class="col-sm-3 col-form-label">Nilai Tugas</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('tugas') == true ? 'is-invalid' : ''; ?>" name="tugas" id="tugas" value="<?= set_value('tugas'); ?>" placeholder="10 s/d 100">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tugas'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="pts" class="col-sm-3 col-form-label">Nilai PTS</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('pts') == true ? 'is-invalid' : ''; ?>" name="pts" id="pts" value="<?= set_value('pts'); ?>" placeholder="10 s/d 100">
                                                <div class="invalid-feedback">
                                                    <?= form_error('pts'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="pas" class="col-sm-3 col-form-label">Nilai PAS</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('pas') == true ? 'is-invalid' : ''; ?>" name="pas" id="pas" value="<?= set_value('pas'); ?>" placeholder="10 s/d 100">
                                                <div class="invalid-feedback">
                                                    <?= form_error('pas'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5">
                                            <label for="pegawai" class="col-sm-3 col-form-label">Pengajar</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" value="<?= $user['name']; ?>" disabled>
                                                <input type="hidden" name="pegawai" value="<?= $user['id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url($role['menu'] . '/nsiswa'); ?>" type="button" class="btn btn-default">Batal</a>
                                <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
                            </div>
                        </form>
                        <!-- /.card-footer -->
                        </form>
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