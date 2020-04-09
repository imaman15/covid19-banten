<link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-select/') ?>css/bootstrap-select.min.css">

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Kecamatan</h1>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" onclick="add_subdistrict()">
                Tambah Kecamatan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center text-white bg-dark">
                            <th width="10px">#</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten/Kota</th>
                            <th width="90px">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add/Update -->
<div class="modal fade" id="subdistrict" tabindex="-1" role="dialog" aria-labelledby="subdistrictLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bolder" id="subdistrictLabel">Kecamatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form">
                    <input type="hidden" name="id_subdistrict" />
                    <div class="form-group row">
                        <label for="id_district" class="col-sm-3 col-form-label text-sm-right font-weight-bold">Kab/Kota</label>
                        <div class="col-sm-9">
                            <select data-header="Pilih Kabupaten/Kota" class="form-control selectpicker show-tick" data-live-search="true" name="id_district" id="id_district">
                                <option value="">Pilih...</option>
                                <?php foreach ($district->result() as $d) : ?>
                                    <option value="<?= $d->id_district; ?>"><?= $d->nama_district ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="id_district_error" style="width: 100%; margin-top: .25rem; font-size: 80%; color: #e74a3b;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_subdistrict" class="col-sm-3 col-form-label text-sm-right font-weight-bold">Nama Kecamatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_subdistrict" id="nama_subdistrict" placeholder="Nama Kabupaten/Kota" value="">
                            <div id="nama_subdistrict_error" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btnSave" onclick="save()" type="button" class="btn btn-primary">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Anda yakin untuk menghapus data ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mesDelete">
                Data yang dihapus tidak akan bisa dikembalikan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btn-delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var save_method;
    var table;
    $(document).ready(function() {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            $('.selectpicker').selectpicker('mobile');
        }

        table = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('volunteer/subdistrict/list') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [-1, 0],
                "className": 'text-center',
                "orderable": false,
            }],
            "oLanguage": {
                "sInfo": "Total _TOTAL_ data, menampilkan data (_START_ sampai _END_)",
                "sInfoFiltered": " - filtering from _MAX_ records",
                "sSearch": "Pencarian :",
                "sInfoEmpty": "Belum ada data untuk saat ini",
                "sLengthMenu": "Menampilkan _MENU_",
                "oPaginate": {
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya"
                },
                "sZeroRecords": "Tidak ada data"
            }
        });

        $("input").change(function() {
            $(this).removeClass('is-invalid');
        });
        $("textarea").change(function() {
            $(this).removeClass('is-invalid');
        });
        $("select").change(function() {
            $(this).removeClass('is-invalid');
        });
        $(".invalid-feedback").change(function() {
            $(this).empty();
        });
        $('#id_district').change(function() {
            $('#id_district_error').empty();
        });

    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    };

    function add_subdistrict() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#btnSave').show();
        $('#btnClose').text('Batal');
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        $('#id_district_error').empty();
        $('#id_district').selectpicker('refresh');
        $('#subdistrict').modal('show'); // show bootstrap modal
        $('#subdistrictLabel').text('Tambah Data'); // Set Title to Bootstrap modal title
    };

    // Edit Data
    function edit_subdistrict(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        $('#id_district_error').empty();
        $('#id_district').selectpicker('refresh');
        $('#btnSave').show();
        $('#btnClose').text('Batal');
        $('#subdistrictLabel').text('Edit Data');

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('volunteer/subdistrict/view') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_subdistrict"]').val(data.id_subdistrict);
                $('[name="nama_subdistrict"]').val(data.nama_subdistrict);
                // $('[name="id_district"]').val(data.id_district);
                $('[name="id_district"]').selectpicker('val', data.id_district);
                $('#subdistrict').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan mendapatkan data dari ajax.</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#subdistrict').modal('hide');
            }
        });
    };

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;
        var act_success;
        var act_danger;

        if (save_method == 'add') {
            url = "<?php echo site_url('volunteer/subdistrict/add') ?>";
            act_success = "ditambahkan";
            act_danger = "menambah";
        } else {
            url = "<?php echo site_url('volunteer/subdistrict/edit') ?>";
            act_success = "diedit";
            act_danger = "mengedit";
        }

        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#subdistrict').modal('hide');
                    $('#the-message').html('<div class="alert alert-success animated zoomIn fast" role="alert">Data berhasil ' + act_success + '.</div>');
                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('#' + data.inputerror[i]).addClass('is-invalid');
                        $('#' + data.inputerror[i] + '_error').text(data.error_string[i]);
                    }
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#subdistrict').modal('hide');
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Data gagal ' + act_success + ' Data.</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    };

    function delete_subdistrict(id) {
        $('#deleteData').modal('show'); // show bootstrap modal
        $('#btn-delete').hide();
        $.ajax({
            url: "<?php echo site_url('volunteer/district/viewdelete') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                if (data.status) {
                    $('#mesDelete').text(data.message);
                    $('#btn-delete').show().attr('onclick', 'deleteBtn(' + id + ')');
                } else {
                    $('#mesDelete').text(data.message);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan mendapatkan data dari ajax.</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#deleteData').modal('hide');
            }
        });

    };

    function deleteBtn(id) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('volunteer/subdistrict/delete') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#the-message').html('<div class="alert alert-success animated zoomIn fast" role="alert">Data berhasil dihapus.</div>');
                // close the message after seconds
                $('.alert-success').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#deleteData').modal('hide');
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Data gagal dihapus.</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#deleteData').modal('hide');
            }
        });
    };
</script>
<script src="<?= base_url('assets/vendor/bootstrap-select/') ?>js/bootstrap-select.min.js"></script>