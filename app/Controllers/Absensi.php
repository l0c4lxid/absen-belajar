<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\JamModel;
use App\Models\UserModel;

class Absensi extends BaseController
{
    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $session = session();
        // Check if the user has the correct user level
        $level_user = $session->get('level_user');
        if ($level_user != 2) {
            // Redirect to the base URL or any other page you prefer
            return redirect()->to(base_url('absensi/kehadiran'));
        }
        $absenModel = new AbsenModel();
        $id_user = $session->get('id_user');
        // Get the query parameters for bulan and tahun
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $data['absensi'] = $absenModel->getAbsenByUserId($id_user, $bulan, $tahun);
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen';
        $data['page'] = 'user/absensi/absen_view';
        $data['navbar'] = 'user/template/v_navbar.php';
        $data['footer'] = 'user/template/v_footer.php';
        $data['sidebar'] = 'user/template/v_sidebar.php';


        return view('user/template/temp_user', $data);
    }
    public function absensi_dua()
    {
        $session = session();

        $absenModel = new AbsenModel();
        $id_user = $session->get('id_user');
        // Get the query parameters for bulan and tahun
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $data['absensi'] = $absenModel->getAbsenByUserId($id_user, $bulan, $tahun);
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen';
        $data['page'] = 'user/absensi/absen_view';
        $data['navbar'] = 'user/template/v_navbar.php';
        $data['footer'] = 'user/template/v_footer.php';
        $data['sidebar'] = 'user/template/v_sidebar.php';


        return view('user/template/temp_user', $data);
    }
    public function Laporan()
    {
        $absenModel = new AbsenModel();
        $userModel = new UserModel();
        $data['users'] = $userModel->where('level_user', 2)->orWhere('level_user', 3)->findAll();

        // Get the query parameters for id_user, bulan, and tahun
        $id_user = $this->request->getGet('id_user');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Jika parameter pencarian tidak ada, tampilkan semua data absensi
        if (!$id_user || !$bulan || !$tahun) {
            $data['absensi'] = $absenModel->findAll();
        } else {
            // Lakukan pencarian data absensi berdasarkan id_user, bulan, dan tahun
            $data['absensi'] = $absenModel->getAbsenByUserId($id_user, $bulan, $tahun);
        }
        $data['userInfo'] = [];
        foreach ($data['users'] as $user) {
            $data['userInfo'][$user['id_user']] = [
                'nama' => $user['nama'],
                'id_user' => $user['id_user'],
            ];
        }
        $data['judul'] = 'Laporan';
        $data['subjudul'] = 'absen-laporan';
        $data['page'] = 'admin/v_absensi';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';

        return view('admin/template/temp_admin', $data);
    }

    public function DataAbsenSatu()
    {
        $absenModel = new AbsenModel();
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen-satu';
        $data['page'] = 'admin/absen_view_satu';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';
        $data['allAbsenWithUserInfo'] = $absenModel->getAbsenSatu();
        // var_dump($data);
        // die;
        return view('admin/template/temp_admin', $data);
    }
    public function DataAbsenDua()
    {
        $absenModel = new AbsenModel();
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen-dua';
        $data['page'] = 'admin/absen_view_dua';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';
        $data['allAbsenWithUserInfo'] = $absenModel->getAbsenDua();
        // var_dump($data);
        // die;
        return view('admin/template/temp_admin', $data);
    }

    public function absen_masuk()
    {
        $session = session();

        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }

        $userId = $session->get('id_user');

        // Check if the user has already done "absen masuk" today in the database
        $today = date('Y-m-d');
        $absenMasukToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->first();

        if ($absenMasukToday) {
            // User has already done "absen masuk" today
            $session->setFlashdata('error', '<div class="card card-warning shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Anda telah melakukan absen masuk hari ini!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
            </div>');
            return redirect()->to(base_url('absensi'));
        }

        // Get the id_jam associated with the user
        $userModel = new UserModel(); // Adjust with your actual UserModel class
        $user = $userModel->find($userId);

        if (!$user || !isset($user['id_jam'])) {
            // Handle the case where user data or id_jam is not found
            return redirect()->to(base_url('absensi'))->with('error', 'Data user tidak valid.');
        }

        $idJam = $user['id_jam'];

        // Validasi jam masuk
        $jamModel = new JamModel(); // Adjust with your actual JamModel class
        $jamData = $jamModel->find($idJam);

        if (!$jamData) {
            // Handle the case where jam data is not found in the database
            return redirect()->to(base_url('absensi'))->with('error', 'Data jam tidak valid.');
        }

        $jamMasuk = date('H:i:s');
        $jamBatasTelatMasukAwal = $jamData['jam_masuk_awal'];
        $jamBatasTelatMasukAkhir = $jamData['jam_masuk_akhir'];

        $masukTelat = ($jamMasuk > $jamBatasTelatMasukAwal && $jamMasuk <= $jamBatasTelatMasukAkhir) ? 2 : 1;

        // Jika belum absen masuk hari ini, simpan data absen masuk
        $data = [
            'id_user' => $userId,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'keterangan' => 'Masuk',
            'masuk_telat' => $masukTelat,
        ];
        $this->absenModel->save($data);

        // Set flash data to show success message in the next request
        $session->setFlashdata('success', '<div class="card card-success shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Absen masuk berhasil!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
        return redirect()->to(base_url('absensi'));
    }
    public function berita_acara()
    {
        $session = session();
        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }
        $userId = $session->get('id_user');

        // Periksa apakah user sudah melakukan "absen masuk" hari ini di database
        $today = date('Y-m-d');

        $beritaacara = $this->request->getPost('berita_acara');

        $data = [
            'berita_acara' => $beritaacara,
        ];
        $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->where('berita_acara', null) // Update hanya jika 'berita_acara' belum diisi
            ->set($data)
            ->update();
        $session->setFlashdata('success', '<div class="card card-success shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Anda telah mengisi berita acara!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>');
        return redirect()->to(base_url('dashboard'));

    }

    public function absen_keluar()
    {
        $session = session();
        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }
        $userId = $session->get('id_user');

        // Periksa apakah user sudah melakukan "absen masuk" hari ini di database
        $today = date('Y-m-d');
        $absenMasukToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->first();

        if (!$absenMasukToday) {
            // User belum melakukan "absen masuk" hari ini, tidak bisa melakukan "absen keluar"
            $session->setFlashdata('error', '<div class="card card-warning shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Anda belum melakukan absen masuk hari ini!</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
            return redirect()->to(base_url('absensi'));
        }

        // Pastikan 'jam_masuk' sudah terisi sebelum mengizinkan 'absen_keluar'
        if (!$absenMasukToday['jam_masuk']) {
            // 'jam_masuk' belum terisi, tidak diizinkan untuk melakukan "absen keluar"
            $session->setFlashdata('error', '<div class="card card-warning shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Anda belum melakukan absen masuk hari ini!</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
            return redirect()->to(base_url('absensi'));
        }

        // Periksa apakah user sudah melakukan "absen keluar" hari ini
        if ($absenMasukToday['jam_keluar']) {
            // User telah melakukan "absen keluar" hari ini
            $session->setFlashdata('error', '<div class="card card-warning shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Anda telah melakukan absen keluar hari ini!</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
            return redirect()->to(base_url('absensi'));
        }
        // Get the selected "id_jam" for the user
        // Get the id_jam associated with the user
        $userModel = new UserModel(); // Adjust with your actual UserModel class
        $user = $userModel->find($userId);

        if (!$user || !isset($user['id_jam'])) {
            // Handle the case where user data or id_jam is not found
            return redirect()->to(base_url('absensi'))->with('error', 'Data user tidak valid.');
        }
        $idJam = $user['id_jam'];

        // Get the "jam_keluar_awal" and "jam_keluar_akhir" values for the selected "id_jam"
        $jamModel = new JamModel();
        $jamData = $jamModel->find($idJam);

        // Validasi jam masuk
        $jamMasuk = date('H:i:s');
        $jamBatasTelatMasukAwal = $jamData['jam_keluar_awal'];
        $jamBatasTelatMasukAkhir = $jamData['jam_keluar_akhir'];

        $keluarTelat = ($jamMasuk >= $jamBatasTelatMasukAwal && $jamMasuk <= $jamBatasTelatMasukAkhir) ? 2 : 1;

        // Jika belum absen keluar hari ini, simpan data absen keluar
        $data = [
            'jam_keluar' => date('Y-m-d H:i:s'),
            'keterangan' => 'Keluar',
            'keluar_telat' => $keluarTelat,
        ];
        $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->where('jam_keluar', null) // Update hanya jika 'jam_keluar' belum diisi
            ->set($data)
            ->update();
        $session->setFlashdata('success', '<div class="card card-danger shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Anda telah melakukan absen keluar hari ini!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
        return redirect()->to(base_url('absensi'));
    }
    public function absen_masuk_dua()
    {
        $session = session();

        // Check if the user is logged in
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }

        $userId = $session->get('id_user');
        $today = date('Y-m-d');

        // Check if the user has already done "absen keluar" today
        $absenKeluarToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_keluar)', $today)
            ->first();

        if ($absenKeluarToday) {
            // User has already done "absen keluar" today
            // Check if the user has already done "absen masuk" twice today
            $countAbsenMasuk = $this->absenModel->where('id_user', $userId)
                ->where('DATE(jam_masuk)', $today)
                ->countAllResults();

            if ($countAbsenMasuk >= 2) {
                // User has already done "absen masuk" twice today
                $session->setFlashdata('error', '<div class="card card-warning shadow">
                    <div class="card-header col-md-12">
                        <h3 class="card-title">Anda hanya dapat melakukan absen masuk dua kali dalam sehari!</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>');
                return redirect()->to(base_url('absensi/kehadiran'));
            }
        } else {
            // User hasn't done "absen keluar" today
            // Check if the user has already done "absen masuk" today
            $absenMasukToday = $this->absenModel->where('id_user', $userId)
                ->where('DATE(jam_masuk)', $today)
                ->first();

            if ($absenMasukToday) {
                // User has already done "absen masuk" today, but hasn't done "absen keluar"
                // Display an error message
                $session->setFlashdata('error', '<div class="card card-warning shadow">
                    <div class="card-header col-md-12">
                        <h3 class="card-title">Anda belum melakukan absen keluar!</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>');
                return redirect()->to(base_url('absensi/kehadiran'));
            }
        }
        $userModel = new UserModel(); // Adjust with your actual UserModel class
        $user = $userModel->find($userId);

        if (!$user || !isset($user['id_jam'])) {
            // Handle the case where user data or id_jam is not found
            return redirect()->to(base_url('absensi'))->with('error', 'Data user tidak valid.');
        }
        $idJam = $user['id_jam'];

        // Get the "jam_keluar_awal" and "jam_keluar_akhir" values for the selected "id_jam"
        $jamModel = new JamModel();
        $jamData = $jamModel->find($idJam);

        $jamBatasTelatKeluarkAwal = $jamData['jam_masuk_awal']; //06.00 
        $jamBatasTelatKeluarAkhir = $jamData['jam_keluar_awal']; //16.30


        // Check if it's the first or second clock-in
        $countAbsenMasuk = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->countAllResults();

        // Validasi jam masuk
        $jamKeluarPertama = date('H:i:s', strtotime($jamBatasTelatKeluarkAwal . ' -1 hour')); //5.00
        $jamKeluarKedua = date('H:i:s', strtotime($jamBatasTelatKeluarAkhir . ' -1 hour')); //8.00


        $jamSekarang = date('H:i:s'); // Mendapatkan jam sekarang

        if ($countAbsenMasuk == 0 && $jamSekarang >= $jamKeluarPertama && $jamSekarang <= $jamBatasTelatKeluarkAwal) {
            // Jika countAbsenMasuk = 0 dan jam sekarang di antara $jamKeluarPertama dan $jamBatasTelatKeluarkAwal
            $masukTelat = 2; // Tepat waktu
        } elseif ($countAbsenMasuk == 1 && $jamSekarang >= $jamKeluarKedua && $jamSekarang <= $jamBatasTelatKeluarAkhir) {
            // Jika countAbsenMasuk = 1 dan jam sekarang di antara $jamKeluarKedua dan $jamBatasTelatKeluarAkhir
            $masukTelat = 2; // Tepat waktu
        } else {
            $masukTelat = 1; // Jika tidak memenuhi kondisi di atas, maka dianggap telat
        }


        // Save "absen masuk" data
        $dataMasuk = [
            'id_user' => $userId,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'keterangan' => 'Masuk',
            'masuk_telat' => $masukTelat,
        ];

        $this->absenModel->save($dataMasuk);

        // Set flash data to show success message in the next request
        $session->setFlashdata('success', '<div class="card card-success shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Absen masuk berhasil!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>');

        return redirect()->to(base_url('absensi/kehadiran'));
    }

    public function absen_keluar_dua()
    {
        $session = session();

        // Check if the user is logged in
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }

        $userId = $session->get('id_user');
        $today = date('Y-m-d');

        // Check the number of "absen masuk" done today by the user
        $countAbsenMasuk = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->countAllResults();

        // Check if the user has already done "absen masuk" today
        $absenMasukToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->first();

        if (!$absenMasukToday || !$absenMasukToday['jam_masuk']) {
            // User hasn't done "absen masuk" today, can't perform "absen keluar"
            $session->setFlashdata('error', '<div class="card card-warning shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Anda belum melakukan absen masuk!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>');
            return redirect()->to(base_url('absensi/kehadiran'));
        }

        // Check if the user has already done "absen keluar" today
        $absenKeluarToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_keluar)', $today)
            ->first();

        if ($absenKeluarToday) {
            // User has already done "absen keluar" today
            // Check if the user has already done "absen keluar" twice today
            $countAbsenKeluar = $this->absenModel->where('id_user', $userId)
                ->where('DATE(jam_keluar)', $today)
                ->countAllResults();

            if ($countAbsenKeluar >= 2) {
                // User has already done "absen keluar" twice today
                $session->setFlashdata('error', '<div class="card card-warning shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Anda hanya dapat melakukan absen keluar dua kali dalam sehari!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>');
                return redirect()->to(base_url('absensi/kehadiran'));
            }
        } else {
            // User hasn't done "absen keluar" today
            // Check if the user has already done "absen masuk" twice today
            if ($countAbsenMasuk > 2) {
                // User has already done "absen masuk" twice today
                $session->setFlashdata('error', '<div class="card card-warning shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Anda hanya dapat melakukan absen masuk dua kali dalam sehari!</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>');
                return redirect()->to(base_url('absensi/kehadiran'));
            }
        }
        // Get the id_jam associated with the user
        $userModel = new UserModel(); // Adjust with your actual UserModel class
        $user = $userModel->find($userId);
        if (!$user || !isset($user['id_jam'])) {
            // Handle the case where user data or id_jam is not found
            return redirect()->to(base_url('absensi'))->with('error', 'Data user tidak valid.');
        }
        $idJam = $user['id_jam'];

        // Get the "jam_keluar_awal" and "jam_keluar_akhir" values for the selected "id_jam"
        $jamModel = new JamModel();
        $jamData = $jamModel->find($idJam);

        $jamBatasTelatKeluarkAwal = $jamData['jam_masuk_akhir']; //9.00
        $jamBatasTelatKeluarAkhir = $jamData['jam_keluar_akhir']; //21.30


        // Check if it's the first or second clock-in
        $countAbsenMasuk = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_keluar)', $today)
            ->countAllResults();

        // Validasi jam keluar
        $jamKeluarPertama = date('H:i:s', strtotime($jamBatasTelatKeluarkAwal) + 3600);
        $jamKeluarKedua = date('H:i:s', strtotime($jamBatasTelatKeluarAkhir) + 3600);

        $jamSekarang = date('H:i:s'); // Mendapatkan jam sekarang

        if ($countAbsenKeluar == 0 && $jamSekarang >= $jamBatasTelatKeluarkAwal && $jamSekarang <= $jamKeluarPertama) {
            // Jika countAbsenMasuk = 0 dan jam sekarang di antara $jamKeluarPertama dan $jamBatasTelatKeluarkAwal
            $keluarTelat = 2; // Tepat waktu
        } elseif ($countAbsenKeluar == 1 && $jamSekarang >= $jamBatasTelatKeluarAkhir && $jamSekarang <= $jamKeluarKedua) {
            // Jika countAbsenMasuk = 1 dan jam sekarang di antara $jamKeluarKedua dan $jamBatasTelatKeluarAkhir
            $keluarTelat = 2; // Tepat waktu
        } else {
            $keluarTelat = 1; // Jika tidak memenuhi kondisi di atas, maka dianggap telat
        }


        // Save "absen keluar" data
        $data = [
            'jam_keluar' => date('Y-m-d H:i:s'),
            'keterangan' => 'Keluar',
            'keluar_telat' => $keluarTelat,
        ];

        $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->where('jam_keluar', null) // Update only if 'jam_keluar' is not filled
            ->set($data)
            ->update();

        $session->setFlashdata('success', '<div class="card card-success shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Anda telah melakukan absen keluar!</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>');

        return redirect()->to(base_url('absensi/kehadiran'));
    }

}