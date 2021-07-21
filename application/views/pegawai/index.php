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
                        <a href="<?= base_url($role['menu'] . '/addp/' . $loc); ?>" class="btn btn-primary btn-xs float-right">
                            <i class="fas fa-plus fa-sm"> </i> Tambah <?= $menu; ?>
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
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($pegawai as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= $row['no_hp']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['role']; ?></td>
                                            <td>
                                                <a href="<?= base_url($role['menu'] . '/detp/' . $row['id'] . '/' . $loc); ?>" type="button" class="btn btn-info btn-xs" alt="Detail">
                                                    <i class="fas fa-eye fa-sm"></i>
                                                </a>
                                                <?php if ($user['role_id'] == "1" || $user['role_id'] == "2") { ?>
                                                    <a href="<?= base_url($role['menu'] . '/editp/' . $row['id'] . '/' . $loc); ?>" type="button" class="btn btn-primary btn-xs">
                                                        <i class="fas fa-pen fa-sm"></i>
                                                    </a>
                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/delp/' . $row['id'] . '/' . $loc); ?>')" href="#!" type="button" class="btn btn-danger btn-xs">
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
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