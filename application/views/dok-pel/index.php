<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <?php if ($user['role_id'] == "1" || $user['role_id'] == "4") { ?>
                    <div class="col-sm-6">
                        <a href="<?= base_url($role['menu'] . '/addpel'); ?>" class="btn btn-primary btn-xs float-right">
                            <i class="fas fa-plus fa-sm"> </i> Tambah Dokumen
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
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Mata Pelajaran</th>
                                        <th>File</th>
                                        <th>Diunggah oleh</th>
                                        <th>Diunggah pada</th>
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
                                            <td><?= $row['kelas']; ?></td>
                                            <td><?= $row['jurusan']; ?></td>
                                            <td><?= $row['mapel']; ?></td>
                                            <td>
                                                <a href="<?= base_url('assets/dist/upload/pelajaran/') . $row['file']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye fa-xs"> </i>
                                                </a>
                                            </td>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= date('d F Y', $row['upload_at']); ?></td>
                                            <td>
                                                <?php if ($user['role_id'] == "1" || $user['role_id'] == "4") { ?>

                                                    <a href="<?= base_url($role['menu'] . '/editpel/' . $row['id_pel']); ?>" type="button" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-pen fa-xs"></i>
                                                    </a>
                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/delpel/' . $row['id_pel']); ?>')" href="#!" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash fa-xs"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Mata Pelajaran</th>
                                        <th>File</th>
                                        <th>Diunggah oleh</th>
                                        <th>Diunggah pada</th>
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