<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= base_url() ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
                <a href="<?= base_url('dashboard'); ?>"
                    class="nav-link <?= $subjudul == 'Dashboard' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('profile/user'); ?>"
                    class="nav-link <?= $subjudul == 'ubah-profile' ? 'active' : '' ?>">
                    <i class=" nav-icon fas fa-id-badge"></i>
                    <p>
                        Ubah Profile
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('absensi'); ?>" class="nav-link <?= $subjudul == 'absen' ? 'active' : '' ?>">
                    <i class=" nav-icon fas fa-user"></i>
                    <p>
                        Absen
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->