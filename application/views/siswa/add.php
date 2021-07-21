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
                        <form class="form-group" action="<?= base_url($role['menu'] . '/addsiswa'); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group row">
                                            <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('nis') == true ? 'is-invalid' : ''; ?>" name="nis" id="nis" value="<?= set_value('nis'); ?>" placeholder="NIS">
                                                <div class="invalid-feedback">
                                                    <?= form_error('nis'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('name') == true ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?= set_value('name'); ?>" placeholder="Nama Lengkap">
                                                <div class="invalid-feedback">
                                                    <?= form_error('name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tempat_lahir" class="col-sm-3 col-form-label">TTL</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm <?= form_error('tempat_lahir') == true ? 'is-invalid' : ''; ?>" name="tempat_lahir" id="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>" placeholder="Tempat">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tempat_lahir'); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="date" class="form-control form-control-sm <?= form_error('tgl_lahir') == true ? 'is-invalid' : ''; ?>" name="tgl_lahir" id="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>" placeholder="Tanggal Lahir">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tgl_lahir'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="form-check col-sm-2 ml-2">
                                                <label class="form-check-label" for="laki_laki">
                                                    <input class="form-check-input" type="radio" name="jk" id="laki_laki" value="Laki-laki" checked>Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check col-sm-2 ml-2">
                                                <label class="form-check-label" for="perempuan">
                                                    <input class="form-check-input" type="radio" name="jk" id="perempuan" value="Perempuan">Perempuan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="anak_ke" class="col-sm-3 col-form-label">Anak ke-</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control form-control-sm <?= form_error('anak_ke') == true ? 'is-invalid' : ''; ?>" name="anak_ke" id="anak_ke" value="<?= set_value('anak_ke'); ?>" placeholder="Anak ke-">
                                                <div class="invalid-feedback">
                                                    <?= form_error('anak_ke'); ?>
                                                </div>
                                            </div>
                                            <label for="dari" class="col-sm-1 col-form-label">dari</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control form-control-sm <?= form_error('dari') == true ? 'is-invalid' : ''; ?>" name="dari" id="dari" value="<?= set_value('dari'); ?>" placeholder="...">
                                                <div class="invalid-feedback">
                                                    <?= form_error('dari'); ?>
                                                </div>
                                            </div>
                                            <label class="col-sm col-form-label">bersaudara</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                            <div class="col-sm">
                                                <textarea class="form-control form-control-sm <?= form_error('alamat') == true ? 'is-invalid' : ''; ?> mb-1" rows="2" name="alamat" id="alamat" placeholder="Alamat Lengkap"><?= set_value('alamat'); ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= form_error('alamat'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-3 col-form-label">No. HP</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('no_hp') == true ? 'is-invalid' : ''; ?>" name="no_hp" id="no_hp" value="<?= set_value('no_hp'); ?>" placeholder="No. HP">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_hp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('tahun_masuk') == true ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masuk" value="<?= set_value('tahun_masuk'); ?>" placeholder="Tahun Masuk">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tahun_masuk'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-3 col-form-label">Foto</label>
                                            <div class="col-sm-2">
                                                <img src="<?= base_url('assets/dist/img/profile/default.jpg'); ?>" class="img-thumbnail" alt="">
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                    <label class="custom-file-label" for="image">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-5 ml-5">
                                        <div class="form-group row">
                                            <label for="nama_ayah" class="col-sm-4 col-form-label">Nama Ayah</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('nama_ayah') == true ? 'is-invalid' : ''; ?>" name="nama_ayah" id="nama_ayah" value="<?= set_value('nama_ayah'); ?>" placeholder="Nama Ayah">
                                                <div class="invalid-feedback">
                                                    <?= form_error('nama_ayah'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pekerjaan_ayah" class="col-sm-4 col-form-label">Pekerjaan Ayah</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" name="pekerjaan_ayah" id="pekerjaan_ayah" value="<?= set_value('pekerjaan_ayah'); ?>" placeholder="Pekerjaan Ayah">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp_ayah" class="col-sm-4 col-form-label">No. HP Ayah</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('no_hp_ayah') == true ? 'is-invalid' : ''; ?>" name="no_hp_ayah" id="no_hp_ayah" value="<?= set_value('no_hp_ayah'); ?>" placeholder="No. HP Ayah">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_hp_ayah'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_ibu" class="col-sm-4 col-form-label">Nama Ibu</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('nama_ibu') == true ? 'is-invalid' : ''; ?>" name="nama_ibu" id="nama_ibu" value="<?= set_value('nama_ibu'); ?>" placeholder="Nama Ibu">
                                                <div class="invalid-feedback">
                                                    <?= form_error('nama_ibu'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pekerjaan_ibu" class="col-sm-4 col-form-label">Pekerjaan Ibu</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" name="pekerjaan_ibu" id="pekerjaan_ibu" value="<?= set_value('pekerjaan_ibu'); ?>" placeholder="Pekerjaan Ibu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp_ibu" class="col-sm-4 col-form-label">No. HP Ibu</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('no_hp_ibu') == true ? 'is-invalid' : ''; ?>" name="no_hp_ibu" id="no_hp_ibu" value="<?= set_value('no_hp_ibu'); ?>" placeholder="No. HP Ibu">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_hp_ibu'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat_orangtua" class="col-sm-4 col-form-label">Alamat Orangtua</label>
                                            <div class="col-sm">
                                                <textarea class="form-control form-control-sm <?= form_error('alamat_orangtua') == true ? 'is-invalid' : ''; ?> mb-1" rows="2" name="alamat_orangtua" id="alamat_orangtua" placeholder="Alamat Orang Tua"><?= set_value('alamat_orangtua'); ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= form_error('alamat_orangtua'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_wali" class="col-sm-4 col-form-label">Nama Wali</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" name="nama_wali" id="nama_wali" value="<?= set_value('nama_wali'); ?>" placeholder="Nama Wali">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pekerjaan_wali" class="col-sm-4 col-form-label">Pekerjaan Wali</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm" name="pekerjaan_wali" id="pekerjaan_wali" value="<?= set_value('pekerjaan_wali'); ?>" placeholder="Pekerjaan Wali">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp_wali" class="col-sm-4 col-form-label">No. HP Wali</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('no_hp_wali') == true ? 'is-invalid' : ''; ?>" name="no_hp_wali" id="no_hp_wali" value="<?= set_value('no_hp_wali'); ?>" placeholder="No. HP Wali">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_hp_wali'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat_wali" class="col-sm-4 col-form-label">Alamat Wali</label>
                                            <div class="col-sm">
                                                <textarea class="form-control form-control-sm mb-1" rows="2" name="alamat_wali" id="alamat_wali" placeholder="Alamat Wali"><?= set_value('alamat_wali'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url($role['menu'] . '/siswa'); ?>" type="button" class="btn btn-default">Batal</a>
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