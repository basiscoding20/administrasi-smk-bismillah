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
                        <form class="form-group" action="<?= base_url($role['menu'] . '/addp/' . $loc); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group row">
                                            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('nip') == true ? 'is-invalid' : ''; ?>" name="nip" id="nip" value="<?= set_value('nip'); ?>" placeholder="NIP">
                                                <div class="invalid-feedback">
                                                    <?= form_error('nip'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('name') == true ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?= set_value('name'); ?>" placeholder="Nama Lengkap">
                                                <div class="invalid-feedback">
                                                    <?= form_error('name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tempat_lahir" class="col-sm-4 col-form-label">TTL</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm <?= form_error('tempat_lahir') == true ? 'is-invalid' : ''; ?>" name="tempat_lahir" id="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>" placeholder="Tempat">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tempat_lahir'); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control form-control-sm <?= form_error('tgl_lahir') == true ? 'is-invalid' : ''; ?>" name="tgl_lahir" id="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>" placeholder="Tanggal Lahir">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tgl_lahir'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
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
                                            <label for="pendidikan_terakhir" class="col-sm-4 col-form-label">Pendidikan Terakhir</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('pendidikan_terakhir') == true ? 'is-invalid' : ''; ?>" name="pendidikan_terakhir" id="pendidikan_terakhir" value="<?= set_value('pendidikan_terakhir'); ?>" placeholder="Pendidikan Terakhir">
                                                <div class="invalid-feedback">
                                                    <?= form_error('pendidikan_terakhir'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-4 col-form-label">No. HP</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('no_hp') == true ? 'is-invalid' : ''; ?>" name="no_hp" id="no_hp" value="<?= set_value('no_hp'); ?>" placeholder="No. HP">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_hp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm">
                                                <input type="email" class="form-control form-control-sm <?= form_error('email') == true ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Email">
                                                <div class="invalid-feedback">
                                                    <?= form_error('email'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun_masuk" class="col-sm-4 col-form-label">Tahun Masuk</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('tahun_masuk') == true ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masuk" value="<?= set_value('tahun_masuk'); ?>" placeholder="Tahun Masuk">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tahun_masuk'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-4 col-form-label">Foto</label>
                                            <div class="col-sm-2">
                                                <img src="<?= base_url('assets/dist/img/profile/default.jpg'); ?>" class="img-thumbnail" alt="">
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input <?= form_error('image') == true ? 'is-invalid' : ''; ?>" id="image" name="image">
                                                    <label class="custom-file-label" for="image">Pilih file</label>
                                                    <div class="invalid-feedback">
                                                        <?= form_error('image'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-5 ml-5">
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                                            <div class="form-check col-sm-2 ml-2">
                                                <label class="form-check-label" for="asn">
                                                    <input class="form-check-input" type="radio" name="status" id="asn" value="ASN" checked>ASN
                                                </label>
                                            </div>
                                            <div class="form-check col-sm-2 ml-2">
                                                <label class="form-check-label" for="honorer">
                                                    <input class="form-check-input" type="radio" name="status" id="honorer" value="Honorer">Honorer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jalan" class="col-sm-4 col-form-label">Jalan</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('jalan') == true ? 'is-invalid' : ''; ?>" name="jalan" id="jalan" value="<?= set_value('jalan'); ?>" placeholder="Jalan">
                                                <div class="invalid-feedback">
                                                    <?= form_error('jalan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desa_kelurahan" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('desa_kelurahan') == true ? 'is-invalid' : ''; ?>" name="desa_kelurahan" id="desa_kelurahan" value="<?= set_value('desa_kelurahan'); ?>" placeholder="Desa/Kelurahan">
                                                <div class="invalid-feedback">
                                                    <?= form_error('desa_kelurahan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('kecamatan') == true ? 'is-invalid' : ''; ?>" name="kecamatan" id="kecamatan" value="<?= set_value('kecamatan'); ?>" placeholder="Kecamatan">
                                                <div class="invalid-feedback">
                                                    <?= form_error('kecamatan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kab_kota" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('kab_kota') == true ? 'is-invalid' : ''; ?>" name="kab_kota" id="kab_kota" value="<?= set_value('kab_kota'); ?>" placeholder="Kabupaten/Kota">
                                                <div class="invalid-feedback">
                                                    <?= form_error('kab_kota'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="provinsi" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('provinsi') == true ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi" value="<?= set_value('provinsi'); ?>" placeholder="Provinsi">
                                                <div class="invalid-feedback">
                                                    <?= form_error('provinsi'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kode_pos" class="col-sm-4 col-form-label">Kode Pos</label>
                                            <div class="col-sm">
                                                <input type="number" class="form-control form-control-sm <?= form_error('kode_pos') == true ? 'is-invalid' : ''; ?>" name="kode_pos" id="kode_pos" value="<?= set_value('kode_pos'); ?>" placeholder="Kode Pos">
                                                <div class="invalid-feedback">
                                                    <?= form_error('kode_pos'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($loc) { ?>
                                            <input type="hidden" name="jabatan" value="<?= $loc_id; ?>">
                                        <?php } else { ?>
                                            <div class="form-group row">
                                                <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                                                <div class="col-sm">
                                                    <select class="form-control form-control-sm" id="jabatan" name="jabatan">
                                                        <?php foreach ($jabatan as $row) { ?>
                                                            <?php if ($row['id'] > 1) { ?>
                                                                <option value="<?= $row['id']; ?>" <?= set_value('jabatan') == $row['id'] ? 'selected' : ''; ?>>
                                                                    <?= $row['role']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a onclick="history.back(-1)" type="button" class="btn btn-default">Batal</a>
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