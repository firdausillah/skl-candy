<?php
require("../../config/excel_reader.php");
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
require "../../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
if ($pg == 'ubah') {
    $data = [
        'nama_siswa' => $_POST['nama'],
        'alamat' => $_POST['alamat']
    ];
    $npsn = $_POST['npsn'];
    $exec = update($koneksi, 'siswa', $data, ['npsn' => $npsn]);
    echo $exec;
}
if ($pg == 'tambah') {
    $data = [
        'npsn'          => $_POST['npsn'],
        'nama_siswa'   => $_POST['nama'],
        'alamat'         => $_POST['alamat'],
        'status'         => 1
    ];
    $exec = insert($koneksi, 'siswa', $data);
    echo $exec;
}
if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'mapel', ['kode_mapel' => $id]);
}
if ($pg == 'tidaklulus') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['keterangan' => 0], ['id' => $id]);
}
if ($pg == 'lulus') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['keterangan' => 1], ['id' => $id]);
}
if ($pg == 'import') {


    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name'])) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        if ($extension <> 'xlsx') {
            echo "harap pilih file excel .xls";
        } else {
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetNames = $spreadsheet->getSheetNames();
            foreach ($sheetNames as $sheetIndex => $sheetName) {

                if ($sheetName == 'mapel') {

                    $sheetData = $spreadsheet->setActiveSheetIndexByName('mapel')->toArray();
                    $sukses = $gagal = 0;
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $urut = $sheetData[$i]['0'];
                        $kode = $sheetData[$i]['1'];
                        $nama = $sheetData[$i]['2'];
                        $kelompok = $sheetData[$i]['3'];
                        $jurusan = $sheetData[$i]['4'];
                        $aktif = $sheetData[$i]['5'];
                        $transkip = $sheetData[$i]['6'];
                        $datax = [
                            'no_urut' => $urut,
                            'kode_mapel' => $kode,
                            'nama_mapel' => $nama,
                            'kelompok' => $kelompok,
                            'jurusan' => $jurusan,
                            'aktif_skl' => $aktif,
                            'aktif_transkip' => $transkip

                        ];
                        $delet = delete($koneksi, 'mapel', ['kode_mapel' => $kode]);
                        $exec = insert($koneksi, 'mapel', $datax);
                        echo mysqli_error($koneksi);
                        ($exec) ? $sukses++ : $gagal++;
                    }
                    echo "Sukses = " . $sukses . " Gagal = " . $gagal;
                }
            }
        }
    }
}
