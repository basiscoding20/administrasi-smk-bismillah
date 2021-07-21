<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url('/'); ?>" class="h1"><b>SMK </b>Bismillah</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('auth'); ?>" method="post">
                <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" id="id" name="id" placeholder="Masukkan NIP/NIS" value="<?= set_value('id'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">

                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->