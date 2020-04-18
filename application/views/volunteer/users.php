<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div id="the-message"></div>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <div class="mt-2 mt-sm-0 px-4 text-center input-group">
                <input id="textUrl" type="text" class="form-control" value="<?php echo $url ?>" aria-label="Link untuk daftar relawan" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Link Pendaftaran Relawan" readonly>
                <div class="input-group-append">
                    <button onclick="myFunction()" data-toggle="tooltip" data-placement="top" title="Salin url ke papan klip" class="btn btn-outline-secondary btn-clipboard" type="button"><i class="fas fa-copy"></i> Salin URL ke Papan Klip</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <span id="navInput" class="d-none"></span>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Akun Aktif <span class="badge badge-success"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notactive-tab" data-toggle="tab" href="#notactive" role="tab" aria-controls="notactive" aria-selected="false">Konfirmasi Akun <span class="badge badge-info"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="blocked-tab" data-toggle="tab" href="#blocked" role="tab" aria-controls="blocked" aria-selected="false">Akun Diblokir <span class="badge badge-danger"></span></a>
                </li>
            </ul>
            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableActive" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center text-white bg-dark">
                                    <th>Foto Profil</th>
                                    <th>Info Relawan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="notactive" role="tabpanel" aria-labelledby="notactive-tab">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableNotActive" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Foto Profil</th>
                                    <th>Info Relawan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="blocked" role="tabpanel" aria-labelledby="blocked-tab">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableBlocked" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Foto Profil</th>
                                    <th>Info Relawan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modelStatus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Role Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="statusForm">
                    <input type="hidden" name="id_users">
                    <div class="form-group">
                        <select class="custom-select" name="status">
                            <option value="1">Administrator</option>
                            <option value="2">Relawan</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick="statuse()" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelAct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btn-act" type="button" class="btn btn-primary">-</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelPass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center input-group">
                    <input id="textPass" type="text" class="form-control" value="Relawan123" aria-label="Password Default" aria-describedby="basic-addon2" data-toggle="tooltip" data-placement="top" title="Password Default" readonly>
                    <div class="input-group-append">
                        <button onclick="myFunctionPass()" data-toggle="tooltip" data-placement="top" title="Salin url ke papan klip" class="btn btn-outline-secondary btn-clipboard" type="button"><i class="fas fa-copy"></i>Salin</button>
                    </div>
                </div>
                <div class="alert alert-info mt-2 small" role="alert">
                    Silahkan salin password default, kemudian klik tombol "Ganti".
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btn-pass" type="button" class="btn btn-primary">Ganti</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var language = {
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
    };
    var coldef = [{
        "targets": [-1, 0],
        "className": 'text-center',
        "orderable": false, //set not orderable
    }, {
        "targets": [1],
        "className": 'text-center',
        "width": "80%"
    }, {
        "targets": [-1],
        "width": "5%"
    }, {
        "targets": [0],
        "width": "15%"
    }];

    $(document).ready(function() {
        table = $('#tableActive').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('volunteer/users/mylist/active') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": coldef,
            "oLanguage": language
        });

        tabledua = $('#tableNotActive').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('volunteer/users/mylist/notactive') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": coldef,
            "oLanguage": language
        });

        tabletiga = $('#tableBlocked').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('volunteer/users/mylist/blocked') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": coldef,
            "oLanguage": language
        });

        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        notif();
        // setInterval(function() {
        //     notif();
        // }, 5000);
    });

    function notif() {
        $.ajax({
            url: "<?php echo site_url('volunteer/users/notif') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('.badge-success').text(data.active);
                    $('.badge-info').text(data.notactive);
                    $('.badge-danger').text(data.blocked);
                } else {
                    $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Notif tidak ada.</div>');
                    // close the message after seconds
                    $('.alert-danger').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
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
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
        tabledua.ajax.reload(null, false);
        tabletiga.ajax.reload(null, false);
        notif();
    };

    function myFunction() {
        var copyText = document.getElementById("textUrl");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    };

    function myFunctionPass() {
        var copyText = document.getElementById("textPass");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    };

    function status_users(id, status) {
        $('#modelStatus').modal('show');
        $('[name="id_users"]').val(id);
        $('[name="status"]').val(status);
    };

    function statuse() {
        var formData = new FormData($('#statusForm')[0]);
        $.ajax({
            url: "<?php echo site_url('volunteer/users/update_status') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modelStatus').modal('hide');
                    $('#the-message').html('<div class="alert alert-success animated zoomIn fast" role="alert">Role akun berhasil diubah.</div>');
                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                    reload_table();
                } else {
                    $('#modelStatus').modal('hide');
                    reload_table();
                    $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Role akun gagal diubah.</div>');
                    // close the message after seconds
                    $('.alert-danger').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#modelStatus').modal('hide');
                reload_table();
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan dalam menyimpan pada database</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
            }
        });
    }

    function active_users(id, act) {
        $('#modelAct').modal('show');

        if (act == 'active') {
            active = 1;
            modalBody = "Aktifkan akun ini ?";
            btnAct = "Aktifkan";
        } else if (act == 'blocked') {
            active = 2;
            modalBody = "Anda yakin untuk blokir akun ini?";
            btnAct = "Blokir";
        }
        $('#modelAct .modal-body').text(modalBody);
        $('#btn-act').text(btnAct).attr('onclick', 'actuse(' + id + ',' + active + ')');
    };

    function actuse(id_users, active) {
        $.ajax({
            url: "<?php echo site_url('volunteer/users/update_active') ?>",
            type: "POST",
            data: {
                id_users: id_users,
                active: active,
            },
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modelAct').modal('hide');
                    $('#the-message').html('<div class="alert alert-success animated zoomIn fast" role="alert">Role akun berhasil diubah.</div>');
                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                    reload_table();
                } else {
                    $('#modelAct').modal('hide');
                    reload_table();
                    $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Role akun gagal diubah.</div>');
                    // close the message after seconds
                    $('.alert-danger').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#modelAct').modal('hide');
                reload_table();
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan dalam menyimpan pada database</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
            }
        });
    };

    function pass_users(id, name) {
        $('#modelPass').modal('show');
        $('#modelPass .modal-title').text('Ganti Password ' + name);
        $('#btn-pass').attr('onclick', "passuse(" + id + ",'" + name + "')");
    };

    function passuse(id_users, name) {
        $.ajax({
            url: "<?php echo site_url('volunteer/users/update_password') ?>",
            type: "POST",
            data: {
                id_users: id_users,
            },
            dataType: "JSON",
            success: function(data) {

                $('#modelPass').modal('hide');
                $('#the-message').html('<div class="alert alert-success animated zoomIn fast" role="alert">Password ' + name + ' berhasil diubah</div>');
                // close the message after seconds
                $('.alert-success').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
                reload_table();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#modelPass').modal('hide');
                reload_table();
                $('#the-message').html('<div class="alert alert-danger animated zoomIn fast" role="alert">Kesalahan dalam menyimpan pada database</div>');
                // close the message after seconds
                $('.alert-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                });
            }
        });
    };
</script>