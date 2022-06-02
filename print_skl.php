<?php ob_start();
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
include "assets/back/vendors/phpqrcode/qrlib.php";
session_start();
if (!isset($_SESSION['id_siswaskl'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$siswa = fetch($koneksi, 'siswa', ['id' => dekripsi($_GET['id'])]);
$skl = fetch($koneksi, 'skl', ['id_skl' => 1]);
$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

//isi qrcode jika di scan
$codeContents = $siswa['nis'] . '-' . $siswa['nama'];

//simpan file kedalam temp
//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

QRcode::png($codeContents, $tempdir . $siswa['nis'] . '.png', QR_ECLEVEL_M, 4);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>SKL_<?= $siswa['nama'] ?></title>

    <style>
        @page {
            margin-top: 0 px !important;
            margin-bottom: 0 px !important;

        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px;
            font-size: 11px;

            min-width: 400px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 4px 7px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
    </style>
</head>

<body style="font-size: 13px;">
    <?php if ($skl['header'] == '') { ?>
        <h3><?= $setting['nama_sekolah'] ?></h3>
        <p><small> <?= $setting['alamat'] ?></small></p>
    <?php } else { ?>
        <img src="<?= $skl['header'] ?>" width="100%">
    <?php } ?>
    <hr>
    <center>
        <h3><u><?= $skl['nama_surat'] ?></u></h3>
        <!-- No. Surat : <?= sprintf("%03d", $siswa['id']); ?><?= $skl['no_surat'] ?><?= date('Y') ?> -->
        No. Surat : <?= $skl['no_surat'] ?>
    </center>

    <div style="padding-left:50px;margin-right:50px ;" class="col-md-12">
        <?= $skl['pembuka'] ?>
        <table style="margin-left: 80px;margin-right:80px" class="table table-sm table-bordered">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><b><?= $siswa['nama'] ?></b></td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td><?= $siswa['tempat'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
            <tr>
                <td>NIS / NISN</td>
                <td>:</td>
                <td><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?> </td>
            </tr>
            <?php if ($skl['wali'] == 1) { ?>
                <tr>
                    <td>Orang Tua / Wali</td>
                    <td>:</td>
                    <td><?= $siswa['wali'] ?> </td>
                </tr>
            <?php } ?>
            <?php if ($siswa['jurusan'] <> null or $siswa['jurusan'] <> "") { ?>
                <tr>
                    <td>Kompetensi Keahlian</td>
                    <td>:</td>
                    <td><?= $siswa['jurusan'] ?></td>
                </tr>
            <?php } ?>

        </table>
        <br>
        <?= $skl['isi_surat'] ?><br>

        <center>
            <?php if ($siswa['keterangan'] == 1) { ?>
                <h3>LULUS</h3>
            <?php } elseif ($siswa['keterangan'] == 2) { ?>
                <h3>LULUS BERSYARAT</h3>
            <?php } else { ?>
                <h3>TIDAK LULUS</h3>
            <?php } ?>
        </center>


        <?php if ($skl['nilaisiswa'] == 1) { ?>
            dengan hasil sebagai berikut :
            <br>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($skl['kelompok'] == 1) { ?>
                        <?php
                        $q1 = mysqli_query($koneksi, "SELECT * FROM mapel group by kelompok order by kelompok");
                        $total = 0;
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {

                            $query = mysqli_query($koneksi, "SELECT * FROM mapel where kelompok='$kelompok[kelompok]' and aktif_skl='1' and (jurusan='$siswa[jurusan]' or jurusan='semua') order by no_urut ");

                        ?>
                            <tr>
                                <td colspan="3"><b><?= $kelompok['kelompok'] ?></b></td>
                            </tr>
                            <?php
                            while ($mapel = mysqli_fetch_array($query)) {

                                $nilai = fetch($koneksi, 'nilai', ['kode_mapel' => $mapel['kode_mapel'], 'nis' => $siswa['nis'], 'semester' => 0]);
                                $total = $total + floatval($nilai['nilai']);
                                $no++;
                            ?>
                                <tr>
                                    <td style="width: 20px;"><?= $no ?></td>
                                    <td><?= $mapel['nama_mapel'] ?></td>
                                    <td style="width: 50px; text-align:center"><?= $nilai['nilai'] ?></td>
                                </tr>
                        <?php }
                        } ?>
                        <tr style="background-color:lightsteelblue;">
                            <td colspan="2"><b>NILAI RATA RATA </b></td>
                            <td style="text-align: center;"><b> <?= round($total / $no, 2)  ?></b></td>

                        </tr>
                    <?php } else { ?>

                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM mapel where (jurusan='$siswa[jurusan]' or jurusan='semua') and aktif_skl='1' order by no_urut ");
                        $no = 0;
                        $total = 0;
                        while ($mapel = mysqli_fetch_array($query)) {
                            $nilai = fetch($koneksi, 'nilai', ['kode_mapel' => $mapel['kode_mapel'], 'nis' => $siswa['nis'], 'semester' => 0]);
                            $no++;
                            $total = $total + floatval($nilai['nilai']);

                        ?>
                            <tr>
                                <td style="width: 20px;"><?= $no ?></td>
                                <td><?= $mapel['nama_mapel'] ?></td>
                                <td style="width: 50px;"><?= $nilai['nilai'] ?></td>
                            </tr>
                        <?php }
                        ?>
                        <tr style="background-color:lightsteelblue;">
                            <td colspan="2"><b>NILAI RATA RATA </b></td>
                            <td><b> <?= round($total / $no, 2)  ?></b></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } ?>
        <?= $skl['penutup'] ?>
        <br>
        <table width="100%">
            <tr>

                <td style="text-align: center;width:180px">
                    <?php if ($skl['foto'] == 1) { ?>
                        <img width="100" class="img" src="admin/mod_photo/upload/<?= $siswa['nis'] ?>.JPG">
                    <?php } ?>

                </td>

                <td style="text-align: center;width:180px">
                    <?php if ($skl['ttd_qrcode'] == 0) { ?>
                        <img class="img" src="temp/<?= $siswa['nis'] ?>.png">
                    <?php }  ?>
                </td>
                <td style="text-align: center">
                    <?= $setting['kota'] ?>, <?= $skl['tgl_surat'] ?><br>
                    Kepala <?= $setting['nama_sekolah'] ?>

                    <?php if ($skl['ttd_qrcode'] == 1) { ?>
                        <p>
                            <img class="img" src="temp/ttd-kepsek.png">
                        </p>
                    <?php } else { ?>
                        <br><br><br><br>
                    <?php } ?>

                    <u><b><?= $setting['nama_kepsek'] ?></b></u>
                    <br>
                    <?= $setting['nip_kepsek'] ?>
                    <?php if ($skl['ttd_qrcode'] == 0) { ?>
                        <br>
                        <?php if ($skl['sttd'] == 1) { ?>
                            <img style="z-index:800;position:absolute;margin-top:-100px;margin-left:60px" class="img" src="<?= $skl['ttd'] ?>" width="<?= $skl['wttd'] ?>">
                        <?php } ?>
                        <?php if ($skl['sstempel'] == 1) { ?>
                            <img style="z-index:920;position:relative;opacity:0.7;margin-top:-110px;margin-left:-150px" class="img" src="<?= $skl['stempel'] ?>" width="<?= $skl['wstempel'] ?>">
                        <?php } ?>
                    <?php } ?>
                </td>

            </tr>
        </table>
    </div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('legal', 'portrait');
$dompdf->render();
$dompdf->stream("SKL_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>