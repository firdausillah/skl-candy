<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="ibox bg-success color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong"><?= rowcount($koneksi, 'siswa') ?></h2>
                <div class="m-b-5">DATA SISWA</div><i class="ti-shopping-cart widget-stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="ibox bg-info color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong"><?= rowcount($koneksi, 'siswa', ['keterangan' => 1]) ?></h2>
                <div class="m-b-5">SISWA LULUS</div><i class="ti-face-smile widget-stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="ibox bg-warning color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong"><?= rowcount($koneksi, 'siswa', ['keterangan' => 0]) ?></h2>
                <div class="m-b-5">SISWA TIDAK LULUS</div><i class="ti-face-sad widget-stat-icon"></i>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="ibox bg-danger color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong"><?= rowcount($koneksi, 'user') ?></h2>
                <div class="m-b-5">DATA USER</div><i class="ti-user widget-stat-icon"></i>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Pengumuman</div>
            </div>
            <div class="ibox-body">
                <ul class="media-list media-list-divider m-0">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman");
                    while ($pengumuman = mysqli_fetch_array($query)) {
                    ?>
                        <li class="media">
                            <a class="media-img" href="javascript:;">
                                <img class="img-circle" src="../assets/back/img/bullhorn.webp" width="40" />
                            </a>
                            <div class="media-body">
                                <div class="media-heading"><?= $pengumuman['judul'] ?> <small class="float-right text-muted"><?= $pengumuman['tgl'] ?></small></div>
                                <div class="font-13"><?= $pengumuman['pengumuman'] ?></div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">History</div>
            </div>
            <div class="ibox-body">
                <ul class="media-list media-list-divider m-0">
                    <?php $query = mysqli_query($koneksi, "SELECT * FROM log a join siswa b ON a.id_user=b.id");
                    while ($log = mysqli_fetch_array($query)) {
                    ?>
                        <li class="media">
                            <a class="media-img" href="javascript:;">
                                <img class="img-circle" src="../assets/back/img/avatar-1.png" width="40" />
                            </a>
                            <div class="media-body">
                                <div class="media-heading"><?= $log['nama'] ?> <small class="float-right text-muted"><?= $log['tgl'] ?></small></div>
                                <div class="font-13"><?= $log['log'] ?></div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>