<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Informasi Corona</h1>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <a href="<?= site_url('administrator/covid/add') ?>" class="btn btn-primary">
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
                    <tbody>
                        <?php foreach ($covid as $c) {  ?>

                            <tr>
                                <td><?= tgl_indo($c->tgl_publish) ?></td>
                                <td><?= $c->nama_district ?></td>
                                <td><?= $c->nama_subdistrict ?></td>
                                <td><?= $c->odp ?></td>
                                <td><?= $c->pdp ?></td>
                                <td><?= $c->positif ?></td>
                                <td><?= $c->sembuh ?></td>
                                <td><?= $c->meninggal ?></td>
                                <td>
                                    <a title="Edit Data" class="btn btn-warning btn-circle btn-sm mb-lg-0 mb-1" href="<?= site_url('volunteer/covid/edit/') . $c->id_covid ?>"><i class="fas fa-edit"></i></a>
                                    <a title="Hapus Data" class="btn_delete btn btn-danger btn-circle btn-sm mb-lg-0 mb-1" data-id="<?= $c->id_covid ?>" onclick="delete_district(<?= $c->id_covid ?>)" href="javascript:0"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
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

    $('.btn_delete').click(function() {
        $('#deleteData').modal('show'); // show bootstrap modal
        var id = $(this).data('id');
        $('#covid_id').val(id);
    });

    $('#btn_delete_confirm').click(function() {
        var id = $('#covid_id').val();
        $.ajax({
                url: "<?php echo site_url('volunteer/covid/delete/') ?>" + id,
                method:"GET",
                data: {id_covid : id},
                success:function(data) {
                    window.location.href = "<?php echo site_url('volunteer/covid') ?>";
                }
            });
    })
</script>

