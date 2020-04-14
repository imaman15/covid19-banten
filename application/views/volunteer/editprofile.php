<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-3 animated zoomIn fast">
                <div class="card-header text-primary text-center">
                    Form Edit Profil
                </div>
                <div class="card-body">
                    <?php echo $this->session->flashdata('message');
                    ?>
                    <?php echo form_open_multipart(M_PROFILE); ?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : null ?>" name="email" id="email" placeholder="Email" value="<?php secho($user->email) ?>" readonly>
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : null ?>" name="name" id="name" placeholder="Nama Lengkap" value="<?php secho(ucfirst($user->name)) ?>">
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">No. Handphone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo form_error('phone') ? 'is-invalid' : null ?>" name="phone" id="phone" placeholder="No. Handphone" aria-describedby="phoneHelpBlock" value="<?php echo $user->phone ?>">
                            <small id="phoneHelpBlock" class="form-text text-muted pl-3">
                                Pastikan nomor handpone anda aktif dan gunakan nomor yang sudah terdaftar di whatsapp jika ada.
                            </small>
                            <?php echo form_error('phone') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Deskripsi tentang Anda</label>
                        <div class="col-sm-9">
                            <textarea class="form-control <?php echo form_error('desc') ? 'is-invalid' : null ?>" name="desc" id="desc" rows="4" placeholder="Deskripsikan tentang Anda" aria-describedby="descHelpBlock"><?php secho($user->desc) ?></textarea>
                            <!-- <small id="descHelpBlock" class="form-text text-muted pl-3">
                                Deskripsi mengenai Anda
                            </small> -->
                            <?php echo form_error('desc'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">Foto Profil</div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo base_url('assets/img/profile/') . $user->photo ?>" alt="" class="img-thumbnail rounded-circle profil-admin">
                                </div>
                                <div class="col-sm-9 my-sm-auto mt-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input clearfix" name="photo" id="photo">
                                        <label class="custom-file-label overflow-hidden" for="photo">Pilih Foto</label>
                                        <div id="rempho" class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="remove_photo" value="<?php echo $user->photo ?>" name="remove_photo">
                                            <label class="custom-control-label" for="remove_photo">Hapus foto saat menyimpan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 offset-md-4 mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Edit</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
<script type="text/javascript">
    var foto = '<?php echo $user->photo ?>';
    $(document).ready(function() {
        $('#rempho').show();
        if (foto == "default.jpg") {
            $('#rempho').hide();
        };
    });

    function numberOnly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    };

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>