<?php
defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger m-b-5" data-toggle="modal" data-target="#importdata">
        Unggah Foto
    </button>&nbsp;
    <div class="alert alert-danger" role="alert">
        <strong>Gunaka Tool ini <a class='btn btn-sm btn-success' href='https://www.bricelam.net/ImageResizer/' target='_blank'>Image Resizer</a> sebelum foto di compres ke zip</strong>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Zip File</label>
                            <input type="file" name="zip_file" class="form-control" required />
                            <input type="submit" name="btn_zip" class="btn btn-info mt-5" value="Unggah" />
                            <small id="helpfile" class="form-text text-muted">Format Nama file harus NIS.JPG dan di compres dengan format .zip</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["btn_zip"])) {
        $output = '';
        if ($_FILES['zip_file']['name'] != '') {
            $file_name = $_FILES['zip_file']['name'];
            $array = explode(".", $file_name);
            $name = $array[0];
            $ext = $array[1];
            if ($ext == 'zip') {
                $path = 'mod_photo/upload/';
                if (!file_exists($path))
                    mkdir($path);

                $location = $path . $file_name;
                if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)) {
                    $zip = new ZipArchive;
                    if ($zip->open($location)) {
                        $zip->extractTo($path);
                        $zip->close();
                    }
                    unlink($location);

                    echo "<script>alert('Suksess Unggah Foto'); location='?pg=foto';</script>";
                }
            } else {
                echo "<script>alert('Hanya .zip yang diperbolehkan'); location='?pg=foto';</script>";
            }
        }
    }
    ?>


</div>

<div class="row">
    <div class='container'>
        <div class="">
            <table class="table table-striped table-sm" id="table-1">
                <thead>
                    <tr>

                        <th>Foto</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Tahun Lulus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "select * from siswa where tahun_lulus='$setting[tahun_lulus]'");
                    $no = 0;
                    while ($siswa = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tr>
                            <td style="width: 150px;" class="gallery"><a><img src="mod_photo/upload/<?= $siswa['nis'] . '.JPG' ?>" width="60" /></a></td>
                            <td> <?= $siswa['nis'] ?></td>
                            <td> <?= $siswa['nama'] ?></td>
                            <td> <?= $siswa['tahun_lulus'] ?></td>
                            <td><a data-id="<?= $siswa['nis'] ?>" class="btn btn-danger btn-sm btn-rounded hapus" href=" #" role="button"><i class="fa fa-trash    "></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .gallery a img {
        float: left;

        height: auto;
        border: 2px solid #fff;
        -webkit-transition: -webkit-transform .15s ease;
        -moz-transition: -moz-transform .15s ease;
        -o-transition: -o-transform .15s ease;
        -ms-transition: -ms-transform .15s ease;
        transition: transform .15s ease;
        position: relative;
    }

    .gallery a:hover img {
        -webkit-transform: scale(2);
        -moz-transform: scale(2);
        -o-transform: scale(2);
        -ms-transform: scale(2);
        transform: scale(2);
        z-index: 5;
    }

    .clear {
        clear: both;
        float: none;
        width: 100%;
    }
</style>
<script>
    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_photo/crud_photo.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
</script>