<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">

    <button type="button" class="btn m-b-5 btn-primary" data-toggle="modal" data-target="#tambahdata">
        Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form-tambah">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul Pengumuman</label>
                            <input type="text" name="judul" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Pengumuman</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="jenis" value="1" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">Internal</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="jenis" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button">Eksternal</span>
                                </label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Isi Pengumuman</label>
                            <textarea name="pengumuman" class="summernote" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data pengumuman</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Judul Penguman</th>
                                <th>Pengumuman</th>
                                <th>Jenis</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from pengumuman");
                            $no = 0;
                            while ($pengumuman = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $pengumuman['judul'] ?></td>
                                    <td><?= $pengumuman['pengumuman'] ?></td>
                                    <td>
                                        <?php if ($pengumuman['jenis'] == 1) { ?>
                                            <span class="badge badge-success">internal</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">eksternal</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button data-id="<?= $pengumuman['id_pengumuman'] ?>" class="hapus btn btn-danger">Hapus</button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?= $no ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form id="form-edit<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $pengumuman['id_pengumuman'] ?>" name="id_pengumuman" class="form-control" required="">
                                                            <div class="form-group">
                                                                <label>Judul Pengumuman</label>
                                                                <input type="text" name="judul" value="<?= $pengumuman['judul'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Jenis Pengumuman</label>
                                                                <div class="selectgroup w-100">
                                                                    <label class="selectgroup-item">
                                                                        <input type="radio" name="jenis" value="1" class="selectgroup-input" checked="">
                                                                        <span class="selectgroup-button">Internal</span>
                                                                    </label>
                                                                    <label class="selectgroup-item">
                                                                        <input type="radio" name="jenis" value="2" class="selectgroup-input">
                                                                        <span class="selectgroup-button">Eksternal</span>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Isi Pengumuman</label>
                                                                <textarea name="pengumuman" class="summernote"><?= $pengumuman['pengumuman'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_pengumuman/crud_pengumuman.php?pg=ubah',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Data Berhasil diubah',
                                                    position: 'topRight'
                                                });
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 2000);
                                                $('#modal-edit<?= $no ?>').modal('hide');
                                                //$('#bodyreset').load(location.href + ' #bodyreset');
                                            }
                                        });
                                        return false;
                                    });
                                </script>
                            <?php }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_pengumuman/crud_pengumuman.php?pg=tambah',
            data: $(this).serialize(),
            success: function(data) {

                iziToast.success({
                    title: 'Mantap!',
                    message: "Data berhasil ditambahkan",
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
                $('#tambahdata').modal('hide');
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });

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
                    url: 'mod_pengumuman/crud_pengumuman.php?pg=hapus',
                    method: "POST",
                    data: 'id_pengumuman=' + id,
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
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>