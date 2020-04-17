<link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-select/') ?>css/bootstrap-select.min.css">

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Masukan Data Covid</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4 shadow mb-4 animated zoomIn fast">
                <div class="card-header text-primary text-center">
                    Form Input Data Covid 19
                </div>
                <div class="card-body">
                    <?php
                    // notifikasi error
                    echo validation_errors('<div class="alert alert-warning">', '</div>');
                    //form open
                    echo form_open_multipart();
                    ?>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kabupaten</label>
                            <select data-header="Pilih Kabupaten/Kota" class="form-control selectpicker show-tick" data-live-search="true" name="id_district" id="id_district">
                                    <option>Pilih Kabupaten</option>
                                    <?php foreach ($kabupaten as $k) { ?>
                                        <option value="<?= $k->id_district ?>" <?php if ($url == 'edit' && ($k->id_district == $covid[0]->id_district)) { echo 'selected'; } ?>><?= $k->nama_district ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kecamatan</label>
                            <select class="form-control" name="id_subdistrict" id="kecamatan">
                                <option value="">Pilih Kabupaten Terlebih dahulu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="odp">ODP (Orang Dalam Pantauan) </label>
                            <input type="number" class="form-control" id="odp" name="odp" value="<?php if ($url == 'edit') { echo $covid[0]->odp; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="odp">PDP (Pasien Dalam Pantauan) </label>
                            <input type="number" class="form-control" id="pdp" name="pdp" value="<?php if ($url == 'edit') { echo $covid[0]->pdp; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="odp">Positif </label>
                            <input type="number" class="form-control" id="postif" name="positif" value="<?php if ($url == 'edit') { echo $covid[0]->positif; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="odp">Sembuh </label>
                            <input type="number" class="form-control" id="sembuh" name="sembuh" value="<?php if ($url == 'edit') { echo $covid[0]->sembuh; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="odp">Meninggal </label>
                            <input type="number" class="form-control" id="meninggal" name="meninggal" value="<?php if ($url == 'edit') { echo $covid[0]->meninggal;} ?>">
                        </div>
                        <div class="text-right">
                            <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $("#kecamatan").attr("disabled", true);
        $("#id_district").change(function() {
            $("#kecamatan").attr("disabled", false);
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('volunteer/Covid/getSubdistrict/') ?>" + id,
                method: "POST",
                data: {
                    id_district: id
                },
                dataType: 'json',

                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id_subdistrict + '">' + data[i].nama_subdistrict + '</option>'
                    }
                    $('#kecamatan').html(html);
                }
            });
        })


    })
</script>
<script src="<?= base_url('assets/vendor/bootstrap-select/') ?>js/bootstrap-select.min.js"></script>