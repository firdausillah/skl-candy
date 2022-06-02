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

if ($pg == 'importnilaimapel') {
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name'])) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        if ($extension <> "xlsx") {
            echo "import file harus .xlsx";
        } else {
            $mapel = $_POST['mapel'];
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetNames = $spreadsheet->getSheetNames();

            foreach ($sheetNames as $sheetIndex => $sheetName) {

                if ($sheetName == 'nilai') {

                    $sheetData = $spreadsheet->setActiveSheetIndexByName('nilai')->toArray();
                    $sukses = $gagal = 0;
                    $semester = $sheetData['2']['2'];
                    mysqli_query($koneksi, "delete from nilai where kode_mapel='$mapel' and semester='$semester'");
                    for ($a = 3; $a < 30; $a++) {
                        $kode = $sheetData['4'][$a];
                        if ($kode == $mapel) {
                            for ($i = 5; $i < count($sheetData); $i++) {
                                $nis = $sheetData[$i]['1'];
                                $kode = $kode;
                                $nilai = $sheetData[$i][$a];
                                $datax = [
                                    'nis' => $nis,
                                    'kode_mapel' => $kode,
                                    'nilai' => $nilai,
                                    'semester' => $semester
                                ];
                                if ($nilai <> "") {
                                    $exec = insert($koneksi, 'nilai', $datax);
                                }
                                echo mysqli_error($koneksi);
                                ($exec) ? $sukses++ : $gagal++;
                            }
                            break;
                        }
                    }
                    echo "Mapel = " . $mapel . " Berhasil = " . $sukses . " Gagal = " . $gagal;
                }
            }
        }
    }
}


if ($pg == 'importmaster') {
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name'])) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetNames = $spreadsheet->getSheetNames();
        foreach ($sheetNames as $sheetIndex => $sheetName) {

            if ($sheetName == 'nilai') {

                $sheetData = $spreadsheet->setActiveSheetIndexByName('nilai')->toArray();
                $semester = $sheetData['2']['2'];
                $sukses = $gagal = 0;
                for ($a = 3; $a < 30; $a++) {
                    $kode = $sheetData['4'][$a];
                    mysqli_query($koneksi, "delete from nilai where kode_mapel='$kode' and semester='$semester'");
                    if ($kode == "") {
                        break;
                    }
                    for ($i = 5; $i < count($sheetData); $i++) {
                        $nis = $sheetData[$i]['1'];
                        $kode = $kode;
                        $nilai = $sheetData[$i][$a];
                        $datax = [
                            'nis' => $nis,
                            'kode_mapel' => $kode,
                            'nilai' => $nilai,
                            'semester' => $semester
                        ];
                        if ($nilai <> "") {
                            $exec = insert($koneksi, 'nilai', $datax);
                        }
                        echo mysqli_error($koneksi);
                        ($exec) ? $sukses++ : $gagal++;
                    }
                }
            }
        }
    }
}


if ($pg == 'import') {
    if (isset($_FILES['file']['name'])) {
        $file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $ext = explode('.', $file);
        $ext = end($ext);
        if ($ext <> 'xls') {
            echo "harap pilih file excel .xls";
        } else {
            $data = new Spreadsheet_Excel_Reader($temp);
            $hasildata = $data->rowcount($sheet_index = 0);
            $sukses = $gagal = 0;

            mysqli_query($koneksi, "truncate mapel");
            for ($i = 2; $i <= $hasildata; $i++) {
                $no_urut = $data->val($i, 1);
                $kode_mapel = $data->val($i, 2);
                $nama_mapel = addslashes($data->val($i, 3));
                $kelompok = addslashes($data->val($i, 4));

                if ($kode_mapel <> "") {
                    $datax = [
                        'no_urut' => $no_urut,
                        'kode_mapel' => $kode_mapel,
                        'nama_mapel' => $nama_mapel,
                        'kelompok'  => $kelompok,

                    ];
                    $exec = insert($koneksi, 'mapel', $datax);
                    echo mysqli_error($koneksi);
                    ($exec) ? $sukses++ : $gagal++;
                }
            }
            $total = $hasildata - 1;
            echo "Berhasil: $sukses | Gagal: $gagal | Dari: $total";
        }
    } else {
        echo "gagal";
    }
}
