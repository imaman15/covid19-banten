<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('volunteer/head'); ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="height: 350px; margin-top:auto; margin-bottom:auto;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <!-- <div class="text-center">
                                        <img src="" alt="">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div> -->
                                    <div class="text-center mb-3">
                                        <img src="<?php echo base_url('assets') ?>/img/logo-banten.png" alt="BMKG" class="img-fluid">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5><b>Pusat Informasi Covid-19</b></h5>
                                        <p class="mt-n2">Provinsi Banten</p>
                                    </div>
                                    <?php
                                    echo $this->session->flashdata('message');
                                    echo form_open(M_ADMIN . '/login', 'class="user"');
                                    ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="email" placeholder="Masukkan alamat email ..." value="<?php echo set_value('email') ?>" autofocus>
                                        <?php echo form_error('email') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" value="<?php echo set_value('password') ?>" placeholder="Masukkan kata sandi ...">
                                        <?php echo form_error('password') ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                    </form>
                                    <hr>
                                    <div class="copyright text-center small">
                                        <span>Copyright &copy; Pusat Informasi Covid-19 Banten <?php echo cr() ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view('volunteer/jsutama');
    ?>

</body>

</html>