<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<!-- Modal -->
<div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-tambah">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama user</label>
                        <input type="text" name="nama" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="level" required>

                            <option value="admin">Administrator</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required="">
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

<div class="row">
    <div class="col-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">DATA USER</div>
                <div class="ibox-tools">
                    <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#tambahdata">
                        Tambah Data
                    </button>
                </div>
            </div>

            <div class="ibox-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from user");
                            $no = 0;
                            while ($user = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $user['nama_user'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['level'] ?></td>
                                    <td>
                                        <?php if ($user['status'] == 1) { ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Non Aktif</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button data-id="<?= $user['id_user'] ?>" class="hapus btn btn-danger btn-sm btn-rounded"><i class="fas fa-trash-alt    "></i> Hapus</button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modal-edit<?= $no ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-edit<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $user['id_user'] ?>" name="id_user" class="form-control" required="">
                                                            <div class="form-group">
                                                                <label>Nama user</label>
                                                                <input type="text" name="nama" value="<?= $user['nama_user'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="level">Level</label>
                                                                <select class="form-control" name="level" required>
                                                                    <option value="admin">Administrator</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ganti Password</label>
                                                                <input type="password" name="password" class="form-control" placeholder="kosongkan jika tidak akan ganti password">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="control-label">Status user</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input type="checkbox" name="status" class="custom-switch-input" value='1' <?php if ($user['status'] == 1) {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description"> Pilih Status</span>
                                                                </label>
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
                                            url: 'mod_user/crud_user.php?pg=ubah',
                                            data: $(this).serialize(),
                                            success: function(data) {
                                                if (data == 'OK') {
                                                    iziToast.success({
                                                        title: 'OKee!',
                                                        message: 'Data Berhasil diubah',
                                                        position: 'topRight'
                                                    });
                                                    setTimeout(function() {
                                                        window.location.reload();
                                                    }, 2000);
                                                    $('#modal-edit<?= $no ?>').modal('hide');
                                                } else {
                                                    iziToast.error({
                                                        title: 'Maaf!',
                                                        message: 'Data Gagal ditambahkan atau username sudah ada',
                                                        position: 'topRight'
                                                    });
                                                }

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
    $(function() {
        $("#txtConfirmPassword").keyup(function() {
            var password = $("#txtNewPassword").val();
            $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
        });

    });
    $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_user/crud_user.php?pg=tambah',
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
                        message: 'Data Gagal ditambahkan atau username sudah ada',
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
                    url: 'mod_user/crud_user.php?pg=hapus',
                    method: "POST",
                    data: 'id_user=' + id,
                    success: function(data) {

                        iziToast.success({
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