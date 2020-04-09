<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Kabupaten / Kota</h1>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" onclick="add_district()">
                Tambah Kabupaten/Kota
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center text-white bg-dark">
                            <th width="10px">#</th>
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
<div class="modal fade" id="district" tabindex="-1" role="dialog" aria-labelledby="districtLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bolder" id="districtLabel">Kabupaten/Kota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form">
                    <input type="hidden" name="id_district" />
                    <div class="form-group row">
                        <label for="nama_district" class="col-sm-3 col-form-label text-sm-right font-weight-bold">Kab/Kota</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_district" id="nama_district" placeholder="Kabupaten/Kota" value="">
                            <div id="nama_district_error" class="invalid-feedback">
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
        table = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('volunteer/district/list') ?>",
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
            $(this).empty()
        });

    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    };

    function add_district() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#btnSave').show();
        $('#btnClose').text('Batal');
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        $('#district').modal('show'); // show bootstrap modal
        $('#districtLabel').text('Tambah Data'); // Set Title to Bootstrap modal title
    };

    // Edit Data
    function edit_district(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        $('#btnSave').show();
        $('#btnClose').text('Batal');
        $('#districtLabel').text('Edit Data');

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('volunteer/district/view') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_district"]').val(data.id_district);
                $('[name="nama_district"]').val(data.nama_district);
                $('#district').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan mendapatkan data dari ajax.</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                $('#district').modal('hide');
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
            url = "<?php echo site_url('volunteer/district/add') ?>";
            act_success = "ditambahkan";
            act_danger = "menambah";
        } else {
            url = "<?php echo site_url('volunteer/district/edit') ?>";
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
                    $('#district').modal('hide');
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
                $('#district').modal('hide');
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

    function delete_district(id) {
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
            url: "<?php echo site_url('volunteer/district/delete') ?>/" + id,
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