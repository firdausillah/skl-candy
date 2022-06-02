<?php
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $sttd = (isset($_POST['sttd'])) ? 1 : 0;
    $sstempel = (isset($_POST['sstempel'])) ? 1 : 0;
    $nilai = (isset($_POST['nilai'])) ? 1 : 0;
    $nilaisiswa = (isset($_POST['nilaisiswa'])) ? 1 : 0;
    $foto = (isset($_POST['foto'])) ? 1 : 0;
    $kelompok = (isset($_POST['kelompok'])) ? 1 : 0;
    $ttdqrcode = (isset($_POST['ttdqrcode'])) ? 1 : 0;
    $wali = (isset($_POST['wali'])) ? 1 : 0;
    $data = [
        'nama_surat' => $_POST['nama'],
        'no_surat' => $_POST['no_surat'],
        'tgl_surat' => $_POST['tgl_surat'],
        'pembuka' => $_POST['pembuka'],
        'isi_surat' => $_POST['isi'],
        'penutup' => $_POST['penutup'],
        'wttd' => $_POST['wttd'],
        'wstempel' => $_POST['wstempel'],
        'sstempel' => $sstempel,
        'sttd' => $sttd,
        'nilai' => $nilai,
        'kelompok' => $kelompok,
        'nilaisiswa' => $nilaisiswa,
        'foto' => $foto,
        'ttd_qrcode' => $ttdqrcode,
        'wali' => $wali
    ];
    $where = [
        'id_skl' => 1
    ];
    $exec = update($koneksi, 'skl', $data, $where);
    echo mysqli_error($koneksi);
    if ($exec) {
        $ektensi = ['jpg', 'png', 'JPG', 'PNG'];
        if ($_FILES['header']['name'] <> '') {
            $header = $_FILES['header']['name'];
            $temp = $_FILES['header']['tmp_name'];
            $ext = explode('.', $header);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'assets/img/header/header' . rand(1, 1000) . '.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $dest);
                if ($upload) {
                    $data2 = [
                        'header' => $dest
                    ];
                    $exec = update($koneksi, 'skl', $data2, $where);
                } else {
                    echo "gagal";
                }
            }
        }
        if ($_FILES['ttd']['name'] <> '') {
            $header = $_FILES['ttd']['name'];
            $temp = $_FILES['ttd']['tmp_name'];
            $ext = explode('.', $header);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'assets/img/header/ttdskl' . rand(1, 1000) . '.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $dest);
                if ($upload) {
                    $data3 = [
                        'ttd' => $dest
                    ];
                    $exec = update($koneksi, 'skl', $data3, $where);
                } else {
                    echo "gagal";
                }
            }
        }
        if ($_FILES['stempel']['name'] <> '') {
            $header = $_FILES['stempel']['name'];
            $temp = $_FILES['stempel']['tmp_name'];
            $ext = explode('.', $header);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'assets/img/header/stempel' . rand(1, 1000) . '.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $dest);
                if ($upload) {
                    $data4 = [
                        'stempel' => $dest
                    ];
                    $exec = update($koneksi, 'skl', $data4, $where);
                } else {
                    echo "gagal";
                }
            }
        }
    } else {
        echo "Gagal menyimpan";
    }
}
