<?php
session_start();
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {

    $data = [
        'judul'        => $_POST['judul'],
        'pengumuman'   => addslashes($_POST['pengumuman']),
        'jenis'        => $_POST['jenis']

    ];
    $id_pengumuman = $_POST['id_pengumuman'];
    update($koneksi, 'pengumuman', $data, ['id_pengumuman' => $id_pengumuman]);
}
if ($pg == 'tambah') {
    $data = [
        'judul'        => $_POST['judul'],
        'pengumuman'   => addslashes($_POST['pengumuman']),
        'jenis'        => $_POST['jenis'],
        'id_user'      => $_SESSION['id_user']
    ];
    $exec = insert($koneksi, 'pengumuman', $data);
    echo mysqli_error($koneksi);
}
if ($pg == 'hapus') {
    $id_pengumuman = $_POST['id_pengumuman'];
    delete($koneksi, 'pengumuman', ['id_pengumuman' => $id_pengumuman]);
}
