<?php
session_start();
require("../config/database.php");
require("../config/function.php");
require("../config/functions.crud.php");
if (isset($_SESSION['id_user'])) {
    $user = mysqli_fetch_array(mysqli_query($koneksi, "select * from user where id_user='$_SESSION[id_user]'"));
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title><?= $setting['nama_sekolah'] ?></title>
        <!-- GLOBAL MAINLY STYLES-->
        <link rel="icon" type="image/png" href="../assets/front/images/icons/favicon.ico" />
        <link href="../assets/back/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/back/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../assets/back/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
        <!-- PLUGINS STYLES-->
        <link href="../assets/back/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
        <!-- THEME STYLES-->
        <link href="../assets/back/css/main.min.css" rel="stylesheet" />
        <link href="../assets/back/css/costum.css" rel="stylesheet" />
        <link href="../assets/back/vendors/izitoast/css/iziToast.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../assets/back/vendors/DataTables/datatables.css">

        <link rel="stylesheet" href="../assets/back/vendors/summernote/summernote-bs4.css">
        <!-- PAGE LEVEL STYLES-->
        <script src="../assets/back/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf8" src="../assets/back/vendors/DataTables/datatables.js"></script>

        <style>
            .btn {
                cursor: pointer
            }

            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background-color: #fff;
                opacity: 0.8;
            }

            .preloader .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                font: 14px arial;
            }
        </style>

    </head>
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Tahun Lulus dan Semester</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formtahunlulus">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <select class="form-control" name="tahun_lulus">
                                <option value="<?= $setting['tahun_lulus'] ?>" selected><?= $setting['tahun_lulus'] ?></option>
                                <?php $query = mysqli_query($koneksi, "Select * from siswa group by tahun_lulus");
                                while ($data = mysqli_fetch_array($query)) { ?>
                                    <option value="<?= $data['tahun_lulus'] ?>"><?= $data['tahun_lulus'] ?></option>
                                <?php  } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="<?= $setting['semester'] ?>" selected><?= $setting['semester'] ?></option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <script>
                    $('#formtahunlulus').submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'mod_setting/crud_setting.php?pg=tahunlulus',
                            data: $(this).serialize(),
                            success: function(data) {

                                iziToast.success({
                                    title: 'Mantap!',
                                    message: 'Data Berhasil diubah',
                                    position: 'topRight'
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);



                            }
                        });
                        return false;
                    });
                </script>
            </div>
        </div>
    </div>

    <body class="fixed-navbar fixed-layout">
        <div class="preloader">
            <div class="loading">
                <img src="../assets/back/img/loader.gif" width="80">
                <p>Harap Tunggu</p>
            </div>
        </div>
        <div class="page-wrapper">
            <!-- START HEADER-->
            <header class="header">
                <div class="page-brand">
                    <a class="link" href="index.html">
                        <img src="../<?= $setting['logo'] ?>" width="40" alt="LOGO">&nbsp;
                        <span class="brand">
                            Candy SKL
                        </span>
                        <span class="brand-mini">CS</span>
                    </a>
                </div>

                <div class="flexbox flex-1">
                    <!-- START TOP-LEFT TOOLBAR-->
                    <ul class="nav navbar-toolbar">
                        <li>
                            <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                        </li>

                    </ul>
                    <!-- END TOP-LEFT TOOLBAR-->
                    <!-- START TOP-RIGHT TOOLBAR-->
                    <ul class="nav navbar-toolbar">
                        <li>

                            <span style="cursor: pointer;" data-toggle="modal" data-target="#modelId">
                                <i class="fa fa-edit"></i>
                                Lulusan - <?= $setting['tahun_lulus'] ?> / Semester - <?= $setting['semester'] ?>
                            </span>
                        </li>
                        <li class="dropdown dropdown-user">
                            <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                                <img src="../assets/back/img/admin-avatar.png" />
                                <span></span><?= $user['nama_user'] ?><i class="fa fa-angle-down m-l-5"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">

                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                            </ul>
                        </li>
                    </ul>
                    <!-- END TOP-RIGHT TOOLBAR-->
                </div>
            </header>
            <!-- END HEADER-->
            <!-- START SIDEBAR-->
            <?php require_once "menu.php"; ?>
            <!-- END SIDEBAR-->
            <div class="content-wrapper">
                <!-- START PAGE CONTENT-->
                <div class="page-content fade-in-up">
                    <?php require_once "content.php"; ?>
                </div>
                <!-- END PAGE CONTENT-->
                <footer class="page-footer">
                    <div class="font-13">CopyRight <?= date('Y') ?> © <b>Candy SKL</b></div>
                    <a class="px-4" href="http://cbtcandy.com" target="_blank">CANDY CBT</a>
                    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                </footer>
            </div>
        </div>
        <!-- BEGIN THEME CONFIG PANEL-->
        <!-- <div class="theme-config">
            <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
            <div class="theme-config-box">
                <div class="text-center font-18 m-b-20">SETTINGS</div>
                <div class="font-strong">LAYOUT OPTIONS</div>
                <div class="check-list m-b-20 m-t-10">
                    <label class="ui-checkbox ui-checkbox-gray">
                        <input id="_fixedNavbar" type="checkbox" checked>
                        <span class="input-span"></span>Fixed navbar</label>
                    <label class="ui-checkbox ui-checkbox-gray">
                        <input id="_fixedlayout" type="checkbox">
                        <span class="input-span"></span>Fixed layout</label>
                    <label class="ui-checkbox ui-checkbox-gray">
                        <input class="js-sidebar-toggler" type="checkbox">
                        <span class="input-span"></span>Collapse sidebar</label>
                </div>
                <div class="font-strong">LAYOUT STYLE</div>
                <div class="m-t-10">
                    <label class="ui-radio ui-radio-gray m-r-10">
                        <input type="radio" name="layout-style" value="" checked="">
                        <span class="input-span"></span>Fluid</label>
                    <label class="ui-radio ui-radio-gray">
                        <input type="radio" name="layout-style" value="1">
                        <span class="input-span"></span>Boxed</label>
                </div>
                <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
                <div class="d-flex m-b-20">
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                        <label>
                            <input type="radio" name="setting-theme" value="default" checked="">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-white"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                        <label>
                            <input type="radio" name="setting-theme" value="blue">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-blue"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                        <label>
                            <input type="radio" name="setting-theme" value="green">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-green"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                        <label>
                            <input type="radio" name="setting-theme" value="purple">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-purple"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                        <label>
                            <input type="radio" name="setting-theme" value="orange">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-orange"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                        <label>
                            <input type="radio" name="setting-theme" value="pink">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-pink"></div>
                            <div class="color-small bg-ebony"></div>
                        </label>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                        <label>
                            <input type="radio" name="setting-theme" value="white">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                        <label>
                            <input type="radio" name="setting-theme" value="blue-light">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-blue"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                        <label>
                            <input type="radio" name="setting-theme" value="green-light">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-green"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                        <label>
                            <input type="radio" name="setting-theme" value="purple-light">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-purple"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                        <label>
                            <input type="radio" name="setting-theme" value="orange-light">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-orange"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                    <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                        <label>
                            <input type="radio" name="setting-theme" value="pink-light">
                            <span class="color-check-icon"><i class="fa fa-check"></i></span>
                            <div class="color bg-pink"></div>
                            <div class="color-small bg-silver-100"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- END THEME CONFIG PANEL-->
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>
        <div class="preloader-backdrop">
            <div class="page-preloader">Loading</div>
        </div>
        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS-->

        <script src="../assets/back/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- PAGE LEVEL PLUGINS-->
        <script src="../assets/back/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/izitoast/js/iziToast.min.js" type="text/javascript"></script>
        <script src="../assets/back/vendors/summernote/summernote-bs4.js"></script>
        <!-- CORE SCRIPTS-->
        <script src="../assets/back/js/app.min.js" type="text/javascript"></script>
        <script>
            $('.preloader').css('display', 'none');
        </script>
        <!-- PAGE LEVEL SCRIPTS-->
        <!-- <script src="../assets/back/js/scripts/dashboard_1_demo.js" type="text/javascript"></script> -->
    </body>

    </html>
<?php
} else {
    include "login.php";
}
?>