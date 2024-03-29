<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img>
        </div>
        <div class="info">
            <a href="<?= base_url('Dashboard') ?>" class="d-block">
                <span>Welcome</span>
                <?= session('username') ?>
            </a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?= base_url('Dashboard'); ?>"
                    class="nav-link <?= $subjudul == 'Dashboard' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('Profile/Admin'); ?>"
                    class="nav-link <?= $subjudul == 'ubah-profile' ? 'active' : '' ?>">
                    <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                    <i class=" nav-icon fas fa-id-badge"></i>
                    <p>
                        Ubah Sandi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('Admin/SemuaUser'); ?>"
                    class="nav-link <?= $subjudul == 'data-magang' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Data User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('Devisi/TambahDevisi'); ?>"
                    class="nav-link <?= $subjudul == 'tambah-devisi' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        Devisi User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('jadwal'); ?>" class="nav-link <?= $subjudul == 'Jam' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        Jam Kerja
                    </p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href=">"
                    class="nav-link ">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Absen
                    </p>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="#" class="nav-link <?= $judul == 'Absensi' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Absen
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url("Absensi/Absensatu") ?>"
                            class="nav-link <?= $subjudul == 'absen-satu' ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon text-primary"></i>
                            <p>Data Absen Satu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url("Absensi/Absendua") ?>"
                            class="nav-link <?= $subjudul == 'absen-dua' ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon text-info"></i>
                            <p>Data Absen Dua</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?= base_url("Absensi/Laporan") ?>"
                    class="nav-link <?= $subjudul == 'absen-laporan' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-print"></i>
                    <p>
                        Laporan Absen
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->