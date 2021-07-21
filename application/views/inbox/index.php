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
                        <a href="<?= base_url($role['menu'] . '/addinbox'); ?>" class="btn btn-primary btn-xs float-right">
                            <i class="fas fa-plus fa-xs"> </i> Tambah Surat Masuk
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
                                        <th>Dari</th>
                                        <th>Perihal</th>
                                        <th>File</th>
                                        <th>Tanggal Terima</th>
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
                                                <?php if (!$row['disposisi']) : ?>
                                                    <span class="badge bg-danger">Menunggu</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success">Disposisi</span>
                                                <?php endif ?>
                                            </td>
                                            <td> <?= $row['no_surat']; ?> </td>
                                            <td><?= $row['dari']; ?></td>
                                            <td><?= $row['perihal']; ?></td>
                                            <td>
                                                <a href="<?= base_url('assets/dist/upload/inbox/') . $row['file']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye fa-xs"> </i>
                                                </a>
                                            </td>
                                            <td><?= $row['tgl_terima']; ?></td>
                                            <td>
                                                <?php if ($user['role_id'] == "1" || $user['role_id'] == "2") { ?>
                                                    <a href="<?= base_url($role['menu'] . '/editinbox/' . $row['id_surat']); ?>" type="button" class="btn btn-primary btn-sm <?= $row['disposisi'] ? 'disabled' : ''; ?>">
                                                        <i class="fas fa-pen fa-xs"></i>
                                                    </a>
                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/delinbox/' . $row['id_surat']); ?>')" href="#!" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash fa-xs"></i>
                                                    </a>
                                                <?php }
                                                if ($user['role_id'] == "1" || $user['role_id'] == "3") { ?>
                                                    <a onclick="disposisiConfirm('<?= base_url($role['menu'] . '/disposisi/' . $row['id_surat']); ?>')" href="#!" type="button" class="btn btn-success btn-sm <?= $row['disposisi'] ? 'invisible disabled' : ''; ?>">
                                                        <i class="fas fa-sign-in-alt fa-xs"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Surat</th>
                                        <th>Dari</th>
                                        <th>Perihal</th>
                                        <th>File</th>
                                        <th>Tanggal Terima</th>
                                        <th>Status</th>
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
<!-- Logout Delete Confirmation-->
<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Surat Masuk akan disposisi.</div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                <a id="btn-disposisi" class="btn btn-primary" href="#">Ya</a>
            </div>
        </div>
    </div>
</div>