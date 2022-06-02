<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger m-b-5" data-toggle="modal" data-target="#importdata">
        Import Semua Nilai
    </button>&nbsp;
    <button type="button" class="btn btn-danger m-b-5" data-toggle="modal" data-target="#importdatamapel">
        Import Nilai Per Mapel
    </button>&nbsp;
    <div class="alert alert-primary" role="alert">
        <strong>disarankan untuk yg jumlah siswanya lebih dari 100 importnya per mapel jangan langsung semuanya yak</strong>
    </div>

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
                            <input type="file" class="form-control-file" name="file" placeholder="" aria-describedby="helpfile" required>
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
    <div class="modal fade" id="importdatamapel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-import-mapel">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Nilai per Mapel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mapel">Pilih Mapel</label>
                            <select class="form-control" name="mapel" id="mapel" required>
                                <?php $query = mysqli_query($koneksi, "select * from mapel");
                                while ($data = mysqli_fetch_array($query)) { ?>
                                    <option value="<?= $data['kode_mapel'] ?>"><?= $data['kode_mapel'] ?> - <?= $data['nama_mapel'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Import File Excel</label>
                            <input type="file" class="form-control-file" name="file" placeholder="" aria-describedby="helpfile" required>
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

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Leger Nilai</h4>
            </div>
            <div class="card-body">
                <!-- <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" name="semester" id="semester">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div> -->
                <div class="table-responsive">
                    <table style="font-size: 11px" class="table table-striped table-sm" id="tablenilai">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <?php
                                $queryx = mysqli_query($koneksi, "select * from mapel order by no_urut");
                                while ($mapel = mysqli_fetch_array($queryx)) { ?>
                                    <th><?= $mapel['kode_mapel'] ?></th>
                                <?php
                                }
                                ?>
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
                                    <?php
                                    $queryx = mysqli_query($koneksi, "select * from mapel order by no_urut");
                                    while ($mapel = mysqli_fetch_array($queryx)) {
                                        $nilai = fetch($koneksi, 'nilai', ['nis' => $siswa['nis'], 'kode_mapel' => $mapel['kode_mapel'], 'semester' => $setting['semester']]);
                                    ?>
                                        <td><?= $nilai['nilai'] ?></td>
                                    <?php
                                    }
                                    ?>
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
    $(document).ready(function() {
        $('#tablenilai').DataTable();
    });
    //IMPORT FILE PENDUKUNG 
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_nilai/crud_nilai.php?pg=importmaster',
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
    $('#form-import-mapel').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_nilai/crud_nilai.php?pg=importnilaimapel',
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
</script>