<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="card shadow mb-4 animated zoomIn fast">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" onclick="add_employee()">
                Lihat Tampilan Relawan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="18px">#</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Akun</th>
                            <th>Diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
    Launch
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mx-auto text-center">
                    <a id="photo" target="_blank"></a>
                    <h4 class="text-primary font-weight-bold" id="name">Nama Lengkap</h4>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="csidn" class="col-sm-5 col-form-label text-sm-right font-weight-bold">Email</label>
                    <div class="col-sm-7 text-primary text-lg my-auto" id="email">
                        email@gmail.com
                    </div>
                </div>
                <div class="form-group row">
                    <label for="csidn" class="col-sm-5 col-form-label text-sm-right font-weight-bold">No Handphone</label>
                    <div class="col-sm-7 text-primary text-lg my-auto" id="phone">
                        +6283845659785
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-5 col-form-label text-sm-right font-weight-bold">Status</label>
                    <div class="col-sm-4">
                        <select class="form-control text-primary samll" name="status" id="status">
                            <option value="1">Administrator</option>
                            <option value="2">Relawan</option>
                        </select>
                    </div>
                    <small class="col-sm-3 text-success my-auto" id="phone">
                        berhasil di simpan
                    </small>
                </div>
                <div class="form-group row">
                    <label for="active" class="col-sm-5 col-form-label text-sm-right font-weight-bold">Akun</label>
                    <div class="col-sm-7 my-auto">
                        <span class="text-primary text-lg" id="active">Aktif</span>
                        <button id="btn_active" type="button" class="btn btn-danger ml-2">Blokir</button>
                        <small id="password_message" class="ml-sm-1 my-2 d-block d-sm-inline">berhasil di simpan</small>
                    </div>
                </div>
                <hr>
                <div class="text-center" id="desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero numquam soluta nisi reprehenderit ad sint porro? Odit tempore voluptate soluta molestiae quos mollitia delectus qui, labore repellat, porro adipisci quod!
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>