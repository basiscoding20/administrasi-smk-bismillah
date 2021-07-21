<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <?php if ($user['role_id'] == "1" || $user['role_id'] == "5") { ?>
                    <div class="col-sm-6">
                        <a href="<?= base_url($role['menu'] . '/addnsiswa'); ?>" class="btn btn-primary btn-xs float-right">
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
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>Tugas</th>
                                        <th>Latihan</th>
                                        <th>PTS</th>
                                        <th>PTA</th>
                                        <!-- <th>Guru</th> -->
                                        <!-- <th>Dinilai pada</th> -->
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
                                            <td><?= $row['name']; ?></td>
                                            <td><?= $row['kelas'] . ' ' . $row['jurusan']; ?></td>
                                            <td><?= $row['mapel']; ?></td>
                                            <td><?= $row['ta1'] . '/' . $row['ta2']; ?></td>
                                            <td><?= $row['semester']; ?></td>
                                            <td><?= $row['latihan']; ?></td>
                                            <td><?= $row['tugas']; ?></td>
                                            <td><?= $row['pts']; ?></td>
                                            <td><?= $row['pas']; ?></td>
                                            <td>
                                                <?php if ($user['role_id'] == "1" || $user['role_id'] == "5") { ?>
                                                    <a href="<?= base_url($role['menu'] . '/editnsiswa/' . $row['id_nilai']); ?>" type="button" class="btn btn-primary btn-xs">
                                                        <i class="fas fa-pen fa-sm"></i>
                                                    </a>
                                                    <a onclick="deleteConfirm('<?= base_url($role['menu'] . '/delnsiswa/' . $row['id_nilai']); ?>')" href="#!" type="button" class="btn btn-danger btn-xs">
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
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>Tugas</th>
                                        <th>Latihan</th>
                                        <th>PTS</th>
                                        <th>PTA</th>
                                        <!-- <th>Guru</th> -->
                                        <!-- <th>Dinilai pada</th> -->
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