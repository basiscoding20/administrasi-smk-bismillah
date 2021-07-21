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
                        <form class="form-group" action="<?= base_url($role['menu'] . '/editinbox/' . $detail['id_surat']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="form-group row">
                                            <label for="no_surat" class="col-sm-3 col-form-label">No. Surat</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('no_surat') == true ? 'is-invalid' : ''; ?>" name="no_surat" id="no_surat" value="<?= $detail['no_surat']; ?>" placeholder="No. Surat">
                                                <div class="invalid-feedback">
                                                    <?= form_error('no_surat'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_terima" class="col-sm-3 col-form-label">Diterima</label>
                                            <div class="col-sm-5">
                                                <input type="date" class="form-control form-control-sm <?= form_error('tgl_terima') == true ? 'is-invalid' : ''; ?>" name="tgl_terima" id="tgl_terima" value="<?= $detail['tgl_terima']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= form_error('tgl_terima'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dari" class="col-sm-3 col-form-label">Dari</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('dari') == true ? 'is-invalid' : ''; ?>" name="dari" id="dari" value="<?= $detail['dari']; ?>" placeholder="Pengirim">
                                                <div class="invalid-feedback">
                                                    <?= form_error('dari'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control form-control-sm <?= form_error('perihal') == true ? 'is-invalid' : ''; ?>" name="perihal" id="perihal" value="<?= $detail['perihal']; ?>" placeholder="Perihal">
                                                <div class="invalid-feedback">
                                                    <?= form_error('perihal'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="file" class="col-sm-3 col-form-label">File</label>
                                            <div class="col-sm">
                                                <div class="custom-file">
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
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url($role['menu'] . '/inbox'); ?>" type="button" class="btn btn-default">Batal</a>
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