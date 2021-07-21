<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/'); ?>" class="brand-link">
        <i class="nav-icon fas fa-school ml-3"></i>
        <span class="brand-text font-weight-light"> <b>SMK</b> Bismillah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url($role['menu'] . '/profile'); ?>" class="d-block">
                    <?= $user['name']; ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url($role['menu']); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($akses['admin']) : ?>
                    <li class="nav-header">ADMINISTRATOR</li>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/akun'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Akun</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['guru']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/guru'); ?>" class="nav-link">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>Data Guru</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['siswa']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/datasiswa'); ?>" class="nav-link">
                            <i class="fas fa-user-graduate nav-icon"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['absensi']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/absensi'); ?>" class="nav-link">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>Dokumen Absensi Siswa</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['pkl']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/nsiswa'); ?>" class="nav-link">
                            <i class="fas fa-user-check nav-icon"></i>
                            <p>Penilaian Siswa</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['pelajaran']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/pelajaran'); ?>" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Dokumen Pelajaran</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['silabus']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/silabus'); ?>" class="nav-link">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Dokumen Silabus</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['pkl']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/doksiswa'); ?>" class="nav-link">
                            <i class="fas fa-paste nav-icon"></i>
                            <p>Dokumen Siswa</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['inbox']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/inbox'); ?>" class="nav-link">
                            <i class="fas fa-file-download nav-icon"></i>
                            <p>Surat Masuk</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['outbox']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/outbox'); ?>" class="nav-link">
                            <i class="fas fa-file-upload nav-icon"></i>
                            <p>Surat Keluar</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['lpj']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/lpj'); ?>" class="nav-link">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Dokumen LPJ</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($akses['arsip']) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url($role['menu'] . '/arsip'); ?>" class="nav-link">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>Laporan Buku Arsip</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>