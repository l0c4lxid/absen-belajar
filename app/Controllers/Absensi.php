<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\UserModel;

class Absensi extends BaseController
{
    public function __construct()
    {
        // Load model yang dibutuhkan
        $this->absenModel = new AbsenModel();
        $this->userModel = new UserModel();
    }
    public function index()
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

    public function Admin()
    {
        $absenModel = new AbsenModel();
        $data['judul'] = 'Absensi';
        $data['subjudul'] = 'absen-all';
        $data['page'] = 'admin/v_absensi';
        $data['navbar'] = 'admin/template/v_navbar.php';
        $data['footer'] = 'admin/template/v_footer.php';
        $data['sidebar'] = 'admin/template/v_sidebar.php';
        $data['allAbsenWithUserInfo'] = $absenModel->getAllAbsenWithUserInfo();
        return view('admin/template/temp_admin', $data);
    }
    public function filter()
    {
        $absenModel = new AbsenModel();
        // Ambil data dari form filter
        $id_user = $this->request->getPost('id_user');
        // Buat array untuk menyimpan kriteria filter
        $filter = [];
        if (!empty($id_user)) {
            $filter['id_user'] = $id_user;
        }
        // Ambil data absen dengan kriteria filter
        $data['allAbsenWithUserInfo'] = $absenModel->getFilteredAbsenWithUserInfo($filter);
        // Memuat view dengan data yang dikirimkan
        return view('admin/v_absensi', $data);
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

        // Jika belum absen masuk hari ini, simpan data absen masuk
        $data = [
            'id_user' => $userId,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'keterangan' => 'Masuk',
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

        // Check if the user has already done "absen masuk" today in the database
        $today = date('Y-m-d');
        $absenMasukToday = $this->absenModel->where('id_user', $userId)
            ->where('DATE(jam_masuk)', $today)
            ->first();

        if (!$absenMasukToday) {
            // User hasn't done "absen masuk" today, can't do "absen keluar"
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

        // Check if the user has already done "absen keluar" today
        if ($absenMasukToday['jam_keluar']) {
            // User has already done "absen keluar" today
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

        // Jika belum absen keluar hari ini, simpan data absen keluar
        $data = [
            'jam_keluar' => date('Y-m-d H:i:s'),
            'keterangan' => 'Keluar',
        ];
        $this->absenModel->where('id_user', $userId)
            ->where('jam_keluar', null)
            ->set($data)
            ->update();

        return redirect()->to(base_url('absensi'));
    }

}