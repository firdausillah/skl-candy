<?php $skl = fetch($koneksi, 'skl', ['id_skl' => 1]) ?>
<div class="row">
    <div class="col-12">
        <div class="ibox">
            <div class="ibox-head">
                <h4>TEMPLATE SKL</h4>
            </div>
            <form id="form-skl">
                <div class="ibox-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Nama Surat</label>
                                <input type="text" class="form-control" name="nama" value="<?= $skl['nama_surat'] ?>" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">No Surat</label>
                                <input type="text" class="form-control" name="no_surat" value="<?= $skl['no_surat'] ?>" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Tanggal Surat</label>
                                <input type="text" class="form-control" name="tgl_surat" value="<?= $skl['tgl_surat'] ?>" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="header">File Header</label>
                        <input type="file" class="form-control-file" name="header" id="header" aria-describedby="fileHelpId">

                    </div>
                    <div class="form-group">
                        <img src="../<?= $skl['header'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Dasar Surat</label>
                        <textarea name="pembuka" class="summernote"><?= $skl['pembuka'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Isi Surat</label>
                        <textarea name="isi" class="summernote"><?= $skl['isi_surat'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Menggunakan Nilai di Admin ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="nilai" value="checkedValue" <?php if ($skl['nilai'] == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Menggunakan Nilai di Siswa ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="nilaisiswa" value="checkedValue" <?php if ($skl['nilaisiswa'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Mau Pakai Kelompok Mapel ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="kelompok" value="checkedValue" <?php if ($skl['kelompok'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pentutup Surat</label>
                        <textarea name="penutup" class="summernote"><?= $skl['penutup'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wstempel">Width Stempel</label>
                                        <input type="text" class="form-control" name="wstempel" id="wstempel" value="<?= $skl['wstempel'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="wstempel">Pakai Stempel</label><br>
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="sstempel" value="checkedValue" <?php if ($skl['sstempel'] == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                            Pakai / Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stempel">Stempel</label>
                                <input type="file" class="form-control-file" name="stempel" id="stempel" aria-describedby="fileHelpId">
                            </div>
                            <div class="form-group">
                                <img src="../<?= $skl['stempel'] ?>" width="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wttd">Width TTD KEPSEK</label>
                                        <input type="text" class="form-control" name="wttd" id="wttd" value="<?= $skl['wttd'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <label for="sttd">Pakai TTD</label><br>
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="sttd" value="checkedValue" <?php if ($skl['sttd'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                            Pakai / Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ttd">TTD KEPSEK</label>
                                <input type="file" class="form-control-file" name="ttd" id="ttd" aria-describedby="fileHelpId">
                            </div>
                            <div class="form-group">
                                <img src="../<?= $skl['ttd'] ?>" width="200">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Mau pakai foto ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="foto" value="checkedValue" <?php if ($skl['foto'] == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Mau pakai ttd kepsek qrcode ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="ttdqrcode" value="checkedValue" <?php if ($skl['ttd_qrcode'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="wstempel">Mau pakai nama wali ?</label><br>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="wali" value="checkedValue" <?php if ($skl['wali'] == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        Pakai / Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Template</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#form-skl').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_skl/crud_skl.php?pg=ubah',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {

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
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>