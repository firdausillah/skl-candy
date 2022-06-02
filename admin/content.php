<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
if ($pg == '') {
    include "home.php";
} elseif ($pg == 'siswa') {
    include "mod_siswa/siswa.php";
} elseif ($pg == 'skl') {
    include "mod_skl/skl.php";  //Modul Detail Pendaftaran
} elseif ($pg == 'bayar') {
    include "mod_bayar/bayar.php";
} elseif ($pg == 'pengumuman') {
    include "mod_pengumuman/pengumuman.php";
} elseif ($pg == 'user') {
    cek_login_admin();
    include "mod_user/user.php";
} elseif ($pg == 'setting') {
    cek_login_admin();
    include "mod_setting/setting.php";
} elseif ($pg == 'mapel') {
    cek_login_admin();
    include "mod_mapel/mapel.php";
} elseif ($pg == 'nilai') {
    cek_login_admin();
    include "mod_nilai/nilai.php";
} elseif ($pg == 'foto') {
    cek_login_admin();
    include "mod_photo/photo.php";
}
