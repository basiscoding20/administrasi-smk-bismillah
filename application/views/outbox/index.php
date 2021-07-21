<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <?php if ($user['role_id'] == "1" || $user['role_id'] == "2") { ?>
                    <div class="col-sm-6">
                        <a href="<?= base_url($role['menu'] . '/addoutbox'); ?>" class="btn btn-primary btn-xs float-right">
                            <i class="fas fa-plus fa-sm"> </i> Tambah Surat Keluar
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status</th>
                                        <th>No. Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <?php if (!$row['is_approved']) : ?>
                                                    <span class="badge bg-danger">Menunggu</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php endif ?>
                                            </td>
                                            <td> <?= $row['no_surat']; ?> </td>
                                            <td><?= date('d F Y', $row['upload_at']); ?></td>
                                            <td><?= $row['perihal']; ?></td>
                                            <td>
                                                <?php if (!$row['is_approved']) : ?>
                                                    <a href="<?= base_url('assets/dist/upload/outbox/') . $row['file']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye fa-xs"> </i>
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?= base_url('assets/dist/upload/outbox/') . $row['is_approved']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye fa-xs"> </i>
                                                    </a>
                                                <?php endif; ?>

                                            </td>
                                            <td>
                                                <?php if ($user['role_id'] == "1" || $user['role_id'] == "2") { ?>
                                                    <a href="<?= base_url($role['menu'] . '/editoutbox/' . $row['id_surat']); ?>" type="button" class="btn btn-primary btn-sm <?= $row['is_approved'] ? 'disabled' : ''; ?>">
                                                        <i class="fas fa-pen fa-xs"></i>
                                                    </a>
                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/deloutbox/' . $row['id_surat']); ?>')" href="#!" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash fa-xs"></i>
                                                    </a>
                                                    <?php
                                                    if (!$row['is_approved']) { ?>
                                                        <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approvedModal<?= $row['id_surat']; ?>">
                                                            <i class="fas fa-check fa-xs"></i>
                                                        </a>
                                                <?php }
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Status</th>
                                        <th>No. Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php foreach ($data as $row) : ?>
    <div class="modal fade" id="approvedModal<?= $row['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="approvedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvedModalLabel">Unggah file yang telah disetujui</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url($role['menu'] . '/is_approved/' . $row['id_surat']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>