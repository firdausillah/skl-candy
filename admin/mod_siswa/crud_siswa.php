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
    delete($koneksi, 'siswa', ['id' => $id]);
}
if ($pg == 'tidaklulus') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['keterangan' => 0], ['id' => $id]);
}
if ($pg == 'lulus') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['keterangan' => 1], ['id' => $id]);
}
if ($pg == 'sklya') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['skl' => 1], ['id' => $id]);
}
if ($pg == 'skltidak') {
    $id = $_POST['id'];
    update($koneksi, 'siswa', ['skl' => 0], ['id' => $id]);
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

            mysqli_query($koneksi, "truncate siswa");
            for ($i = 2; $i <= $hasildata; $i++) {
                $nopes = $data->val($i, 2);
                $nisn = addslashes($data->val($i, 3));
                $nis = addslashes($data->val($i, 4));
                $nama = addslashes($data->val($i, 5));
                $tempat = addslashes($data->val($i, 6));
                $tgl = addslashes($data->val($i, 7));
                $kelas = addslashes($data->val($i, 8));
                $jurusan = addslashes($data->val($i, 9));
                $keterangan = addslashes($data->val($i, 10));
                $password = addslashes($data->val($i, 11));
                if ($nama <> "") {
                    $datax = [
                        'nis' => $nis,
                        'nisn' => $nisn,
                        'nopes' => $nopes,
                        'nama'  => $nama,
                        'tempat' => $tempat,
                        'tgl_lahir' => $tgl,
                        'kelas' => $kelas,
                        'jurusan' => $jurusan,
                        'keterangan' => $keterangan,
                        'password' => $password,
                        'status' => 1
                    ];
                    $exec = insert($koneksi, 'siswa', $datax);
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
if ($pg == 'importsiswa') {
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
            echo "harap pilih file excel .xlsx";
        } else {
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetNames = $spreadsheet->getSheetNames();
            foreach ($sheetNames as $sheetIndex => $sheetName) {
                if ($sheetName == 'siswa') {

                    $sheetData = $spreadsheet->setActiveSheetIndexByName('siswa')->toArray();
                    $sukses = $gagal = 0;
                    for ($i = 1; $i < count($sheetData); $i++) {

                        $nis = $sheetData[$i]['1'];
                        $nisn = $sheetData[$i]['2'];
                        $nama = $sheetData[$i]['3'];
                        $tempat = $sheetData[$i]['4'];
                        $tgllahir = $sheetData[$i]['5'];
                        $kelas = $sheetData[$i]['6'];
                        $jurusan = $sheetData[$i]['7'];
                        $keterangan = $sheetData[$i]['8'];
                        $nohp = $sheetData[$i]['9'];
                        $password = $sheetData[$i]['10'];
                        $tahun_lulus = $sheetData[$i]['11'];
                        $wali = $sheetData[$i]['12'];
                        $cekid = rowcount($koneksi, 'siswa', ['id' => $nis]);
                        if ($cekid <> 0) {
                            $exec = delete($koneksi, 'siswa', ['id' => $nis]);
                        }
                        $datax = [
                            'id' => $nis,
                            'nis' => $nis,
                            'nisn' => $nisn,
                            'nama' => addslashes($nama),
                            'tempat' => $tempat,
                            'tgl_lahir' => $tgllahir,
                            'kelas' => $kelas,
                            'jurusan' => $jurusan,
                            'keterangan' => $keterangan,
                            'nohp' => $nohp,
                            'status' => 1,
                            'password' => $password,
                            'skl' => 1,
                            'tahun_lulus' => $tahun_lulus,
                            'wali' => $wali
                        ];
                        $exec = insert($koneksi, 'siswa', $datax);
                        echo mysqli_error($koneksi);
                        ($exec) ? $sukses++ : $gagal++;
                    }
                    echo "Sukses = " . $sukses . " Gagal = " . $gagal;
                }
            }
        }
    }
}
