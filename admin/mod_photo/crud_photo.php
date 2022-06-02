<?php
require("../../config/excel_reader.php");
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");


session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

if ($pg == 'hapus') {
    $id = $_POST['id'];
    unlink('upload/' . $id . '.JPG');
}
