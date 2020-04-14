<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-3 animated zoomIn fast">
                <div class="card-header text-primary text-center">
                    Form Ganti Kata Sandi
                </div>
                <div class="card-body">
                    <?php echo $this->session->flashdata('message');
                    ?>
                    <?php echo form_open(M_PASSWORD); ?>
                    <div class="form-group">
                        <label for="currentPassword">Kata Sandi Saat ini</label>
                        <input type="password" class="form-control <?php echo form_error('currentPassword') ? 'is-invalid' : null ?>" name="currentPassword" id="currentPassword" placeholder="Masukkan Kata Sandi Saat ini">
                        <?php echo form_error('currentPassword') ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi Baru</label>
                        <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : null ?>" name="password" id="password" placeholder="Masukkan Kata Sandi Baru" aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted pl-3">(Kata sandi minimal 6 karakter dan berisi kombinasi dari huruf kecil, huruf besar dan angka )</small>
                        <?php echo form_error('password') ?>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control <?php echo form_error('confirmPassword') ? 'is-invalid' : null ?>" name="confirmPassword" id="confirmPassword" placeholder=" Masukkan Konfirmasi Kata Sandi Baru">
                        <?php echo form_error('confirmPassword') ?>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Atur Ulang Kata Sandi</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>