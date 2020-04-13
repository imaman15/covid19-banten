<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Masukan Berita & Info Kesehatan</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4 shadow mb-4 animated zoomIn fast">
                <div class="card-header text-primary text-center">
                    Form Input Berita & Info Kesehatan
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
                            <label for="title">Judul Berita</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if($url == 'edit') { echo $news[0]->title;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Pilih Kategori</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="1">Info Kesehatan</option>
                                <option value="2">Berita Covid 19</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="images">Gambar Utama </label>
                            <input type="file" class="form-control" id="images" name="images">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content</label>
                            <textarea class="form-control" id="summernote" rows="3" name="content"><?php if($url == 'edit') { echo $news[0]->content;} ?></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" id="btnSave" class="btn btn-primary"><?= ($url == 'edit') ? "Update" : "Simpan"; ?></button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/summernote/summernote-bs4.js') ?>"></script>
<script>

$(document).ready(function(){
    $('#summernote').summernote({
        height: "300px",
        callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
        }
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('volunteer/news/upload_image')?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
            $('#summernote').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: "<?php echo site_url('volunteer/news/delete_image')?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }
        
});
    

         
</script>