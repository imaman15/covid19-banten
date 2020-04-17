<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Informasi Corona</h1>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <a href="<?= site_url(M_COVID_ADD) ?>" class="btn btn-primary">
                Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataCovid" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center text-white bg-dark">
                            <th>Tanggal Publish</th>
                            <th>Kabupaten / Kota</th>
                            <th>Kecamatan</th>
                            <th>ODP (Orang Dalam Pengawasan)</th>
                            <th>PDP (Pasien Dalam Pengawasan)</th>
                            <th>Positif</th>
                            <th>Sembuh</th>
                            <th>Meninggal</th>
                            <th width="90px">Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <input type="hidden" id="covid_id">
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
                <button id="btn_delete_confirm" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        table = $('#dataCovid').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('volunteer/covid/myList') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [-1],
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
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    };

    // $('#btn_delete').click(function() {
    //     $('#deleteData').modal('show'); // show bootstrap modal
    //     var id = $(this).data('id');
    //     $('#covid_id').val(id);
    // });

    function btn_delete(params) {
        $('#deleteData').modal('show'); // show bootstrap modal
        $('#covid_id').val(params);
    }

    $('#btn_delete_confirm').click(function() {
        var id = $('#covid_id').val();
        $.ajax({
            url: "<?php echo site_url('volunteer/covid/delete/') ?>" + id,
            method: "GET",
            data: {
                id_covid: id
            },
            success: function(data) {
                reload_table();
                $('#deleteData').modal('hide');
            }
        });
    })
</script>