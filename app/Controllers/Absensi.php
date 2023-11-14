<?php

namespace App\Controllers;

use App\Models\AbsenModel;
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
        $data['page'] = 'user/absensi/absen_view_cs';
        $data['navbar'] = 'user/template/v_navbar.php';
        $data['footer'] = 'user/template/v_footer.php';
        $data['sidebar'] = 'user/template/v_sidebar.php';


        return view('user/template/temp_user', $data);
    }
    public function Laporan()
    {
        $absenModel = new AbsenModel();
        $userModel = new UserModel();
        $data['users'] = $userModel->where('level_user', 2)->findAll();

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
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen-laporan';
        $data['page'] = 'admin/v_absensi';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';

        return view('admin/template/temp_admin', $data);
    }

    public function Admin()
    {
        $absenModel = new AbsenModel();
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen-all';
        $data['page'] = 'admin/absen_view';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';
        $data['allAbsenWithUserInfo'] = $absenModel->getAllAbsenWithUserInfo();
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

        // Validasi jam masuk
        $jamMasuk = date('H:i:s');
        $jamBatasTelat = '08:30:00';

        $masukTelat = ($jamMasuk > $jamBatasTelat) ? 1 : 2;

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
        // Validasi jam masuk
        $jamMasuk = date('H:i:s');
        $jamBatasAwal = '15:00:00';
        $jamBatasAkhir = '15:30:00';

        $keluarTelat = ($jamMasuk >= $jamBatasAwal && $jamMasuk <= $jamBatasAkhir) ? 2 : 1;

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

        // Save "absen masuk" data
        $dataMasuk = [
            'id_user' => $userId,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'keterangan' => 'Masuk',
            'masuk_telat' => null,
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

        // Check if the user has already done "absen masuk" twice today
        if ($countAbsenMasuk < 2) {
            // User hasn't done "absen masuk" twice today
            $session->setFlashdata('error', '<div class="card card-warning shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Anda harus melakukan absen masuk dua kali sebelum melakukan absen keluar!</h3>
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
            // Save "absen keluar" data
            $data = [
                'jam_keluar' => date('Y-m-d H:i:s'),
                'keterangan' => 'Keluar',
                'keluar_telat' => null,
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
        }

        return redirect()->to(base_url('absensi/kehadiran'));
    }


}