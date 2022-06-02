<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger m-b-5" data-toggle="modal" data-target="#importdata">
        Import Data Siswa
    </button>&nbsp;
    <a class="btn btn-danger m-b-5" href="mod_siswa/print_skl_semua.php">
        Cetak Semua SKL
    </a>

    <!-- Modal -->
    <div class="modal fade" id="importdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-import">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Import File Excel</label>
                            <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="helpfile" required>
                            <small id="helpfile" class="form-text text-muted">File harus .xlsx</small>
                        </div>
                        <p><a href="excel/importmaster.xlsx">Download Format</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <button type="button" class="btn m-b-5 btn-primary" data-toggle="modal" data-target="#tambahdata">
        Tambah Data
    </button>

   
    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nopes</label>
                            <input type="text" name="npsn" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Nama siswa</label>
                            <input type="text" name="nama" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->


</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data siswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>NIS</th>
                                <th>Nama siswa</th>
                                <th>Tempat</th>
                                <th>Tgl Lahir</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Keterangan</th>
                                <th>SKL</th>
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
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $siswa['tempat'] ?></td>
                                    <td><?= $siswa['tgl_lahir'] ?></td>
                                    <td><?= $siswa['kelas'] ?></td>
                                    <td><?= $siswa['jurusan'] ?></td>
                                    <td>
                                        <?php if ($siswa['keterangan'] == 1) { ?>
                                            <a data-id="<?= $siswa['id'] ?>" class="lulus badge badge-success">LULUS</a>
                                        <?php } elseif ($siswa['keterangan'] == 2) { ?>
                                            <a data-id="<?= $siswa['id'] ?>" class=" badge badge-warning">LULUS BERSYARAT</a>
                                        <?php } else { ?>
                                            <a data-id="<?= $siswa['id'] ?>" class="tidaklulus badge badge-danger">TIDAK LULUS</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($siswa['skl'] == 1) { ?>
                                            <button data-id="<?= $siswa['id'] ?>" class="sklya btn btn-success btn-sm btn-rounded"><i class="fa fa-check    "></i></button>

                                        <?php } else { ?>
                                            <button data-id="<?= $siswa['id'] ?>" class="skltidak btn btn-danger btn-sm btn-rounded"><i class="fa fa-times    "></i></button>
                                        <?php } ?>


                                    </td>
                                    <td>
                                        <a target="_blank" href="mod_siswa/print_skl.php?id=<?= enkripsi($siswa['id']) ?>" class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-print"></i></a>
                                        <a target="_blank" href="mod_siswa/transkip_nilai.php?id=<?= enkripsi($siswa['id']) ?>" class="btn btn-sm btn-rounded btn-warning"><i class="fa fa-print"></i></a>

                                        <button data-id="<?= $siswa['id'] ?>" class="hapus btn-sm btn-rounded btn btn-danger"><i class="fa fa-trash    "></i></button>

                                    </td>
                                </tr>

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
    //IMPORT FILE PENDUKUNG 
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_siswa/crud_siswa.php?pg=importsiswa',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
                $('.preloader').css('display', 'block');
            },
            success: function(data) {
                $('.preloader').css('display', 'none');
                $('#importdata').modal('hide');
                iziToast.success({
                    title: 'Mantap!',
                    message: data,
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);


            }
        });
    });
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_siswa/crud_siswa.php?pg=tambah',
            data: $(this).serialize(),
            success: function(data) {
                if (data == 'OK') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data Berhasil ditambahkan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    $('#tambahdata').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Data Gagal ditambahkan',
                        position: 'topRight'
                    });
                }
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
                    url: 'mod_siswa/crud_siswa.php?pg=hapus',
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
    $('#table-1').on('click', '.lulus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Membuat siswa ini tidak lulus!',
            buttons: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_siswa/crud_siswa.php?pg=tidaklulus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil diupdate',
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
    $('#table-1').on('click', '.tidaklulus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Meluluskan siswa ini!',
            buttons: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_siswa/crud_siswa.php?pg=lulus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil diupdate',
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

    $('#table-1').on('click', '.sklya', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Membuat siswa tidak bisa mencetak SKL!',
            buttons: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_siswa/crud_siswa.php?pg=skltidak',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil diupdate',
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
    $('#table-1').on('click', '.skltidak', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Membuat siswa bisa mencetak SKL!',
            buttons: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_siswa/crud_siswa.php?pg=sklya',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil diupdate',
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