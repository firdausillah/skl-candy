<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $status = (isset($_POST['status'])) ? 1 : 0;
    if ($_POST['password'] <> "") {
        $data = [
            'username'     => $_POST['username'],
            'nama_user'   => $_POST['nama'],
            'level'         => $_POST['level'],
            'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status'         => $status
        ];
    } else {
        $data = [
            'username'     => $_POST['username'],
            'nama_user'   => $_POST['nama'],
            'level'         => $_POST['level'],
            'status'         => $status
        ];
    }
    $id_user = $_POST['id_user'];
    $exec = update($koneksi, 'user', $data, ['id_user' => $id_user]);
    echo $exec;
}
if ($pg == 'tambah') {
    $data = [
        'username'     => $_POST['username'],
        'nama_user'   => $_POST['nama'],
        'level'         => $_POST['level'],
        'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'status'         => 1
    ];
    $exec = insert($koneksi, 'user', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id_user = $_POST['id_user'];
    delete($koneksi, 'user', ['id_user' => $id_user]);
}
