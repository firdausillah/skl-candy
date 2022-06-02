<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="../assets/back/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong"><?= $user['nama_user'] ?></div><small>Administrator</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="."><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <li class="heading">MAIN MENU</li>
            <li>
                <a href="?pg=siswa"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Data Siswa</span>
                </a>
            </li>
            <li>
                <a href="?pg=foto"><i class="sidebar-item-icon fa fa-image"></i>
                    <span class="nav-label">Foto Siswa</span>
                </a>
            </li>
            <li>
                <a href="?pg=mapel"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="?pg=nilai"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Leger Nilai</span>
                </a>
            </li>

            <li>
                <a href="?pg=skl"><i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Setting SKL</span>
                </a>
            </li>
            <li>
                <a href="?pg=pengumuman"><i class="sidebar-item-icon fa fa-bullhorn"></i>
                    <span class="nav-label">Pengumuman</span>
                </a>
            </li>
            <li class="heading">PENGATURAN</li>
            <li>
                <a href="?pg=user"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Manajemen User</span>
                </a>
            </li>
            <li>
                <a href="?pg=setting"><i class="fa fa-gears  sidebar-item-icon  "></i>
                    <span class="nav-label">Setting Aplikasi</span>
                </a>
            </li>

        </ul>
    </div>
</nav>