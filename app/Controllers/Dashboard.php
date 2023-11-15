<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\DevisiModel;
use App\Models\JamModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->devisiModel = new DevisiModel();
        $this->pegawaiModel = new UserModel();
        $this->absenModel = new AbsenModel();
    }
    public function index()
    {
        // Ambil data user dari session
        $session = session();
        $level_user = $session->get('level_user');

        if ($level_user == 1) {
            $devisiModel = new DevisiModel();
            $pegawaiModel = new UserModel();
            $absenModel = new AbsenModel();

            // Menghitung jumlah devisi berdasarkan jumlah id_devisi
            $jumlahDevisi = $devisiModel->countAllResults();
            // Menghitung jumlah pegawai dengan level_user = 2
            $jumlahPegawai = $pegawaiModel->where('level_user', 2)->orWhere('level_user', 3)->countAllResults();

            $currentDate = date('Y-m-d');

            // Menghitung jumlah absen masuk dan keluar pada hari ini
            $jumlahAbsenMasukKeluar = $absenModel->whereIn('keterangan', ['Masuk', 'Keluar'])
                ->where('DATE(jam_masuk)', $currentDate)
                ->orWhere('DATE(jam_keluar)', $currentDate)
                ->groupBy('id_user') // Group by user ID to count each user once
                ->countAllResults();

            // Menghitung jumlah absen keluar pada hari ini
            $jumlahAbsenKeluar = $absenModel->where('keterangan', 'Keluar')
                ->where('DATE(jam_keluar)', $currentDate)
                ->groupBy('id_user') // Group by user ID to count each user once
                ->countAllResults();

            // Menghitung jumlah pegawai yang belum absen masuk pada hari ini
            $jumlahPegawaiBelumAbsenMasuk = $jumlahPegawai - $jumlahAbsenMasukKeluar;

            // Menghitung jumlah pegawai yang belum absen keluar pada hari ini
            $jumlahPegawaiBelumAbsenKeluar = $jumlahPegawai - $jumlahAbsenKeluar;


            $data = [
                'judul' => 'Dashboard',
                'subjudul' => 'Dashboard',
                'page' => 'admin/v_dashboard.php',
                'navbar' => 'admin/template/v_navbar.php',
                'footer' => 'admin/template/v_footer.php',
                'sidebar' => 'admin/template/v_sidebar.php',
                'jumlahDevisi' => $jumlahDevisi,
                'jumlahPegawai' => $jumlahPegawai,
                'jumlahAbsenMasuk' => $jumlahPegawaiBelumAbsenMasuk,
                'jumlahAbsenKeluar' => $jumlahPegawaiBelumAbsenKeluar,

            ];
            // Jika level_user adalah admin, tampilkan view admin_dashboard
            return view('admin/template/temp_admin', $data);
        } elseif ($level_user == 2) {

            $absenModel = new AbsenModel();
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
            $absenKeluarToday = $this->absenModel->where('id_user', $userId)
                ->where('DATE(jam_keluar)', $today)
                ->first();

            // Get the "jam_keluar_awal" value based on the user's "id_jam"
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

            $jamBatasTelatKeluarAwal = $jamData['jam_keluar_awal'];
            $jamBatasTelatKeluarAkhir = $jamData['jam_keluar_akhir'];

            $hasAbsenToday = ($absenMasukToday) ? true : false;
            $hasAbsenTodayKeluar = ($absenKeluarToday) ? true : false;

            $data = [
                'judul' => 'Dashboard',
                'subjudul' => 'Dashboard',
                'page' => 'user/user_dashboard',
                'navbar' => 'user/template/v_navbar.php',
                'footer' => 'user/template/v_footer.php',
                'sidebar' => 'user/template/v_sidebar.php',
                'hasAbsenToday' => $hasAbsenToday,
                'hasAbsenTodayKeluar' => $hasAbsenTodayKeluar,
                'jamKeluarAwal' => $jamBatasTelatKeluarAwal,
                'jamKeluarAkhir' => $jamBatasTelatKeluarAkhir,
            ];
            // var_dump($data);
            // die;
            // Jika level_user adalah user, tampilkan view user_dashboard
            return view('user/template/temp_user', $data);
        } elseif ($level_user == 3) {

            $absenModel = new AbsenModel();
            $session = session();
            $userId = $session->get('id_user');
            $userLevel = $session->get('level_user');
            // Pastikan user telah login dan sesi telah berisi data user dengan level_user
            if (!$session->has('id_user') || !$session->has('level_user')) {
                return redirect()->to(base_url());
            }

            // Cek jumlah absen masuk dan absen keluar yang telah dilakukan hari ini
            $countAbsenMasuk = $absenModel->where('id_user', $userId)
                ->where('DATE(jam_masuk)', date('Y-m-d'))
                ->countAllResults();

            $countAbsenKeluar = $absenModel->where('id_user', $userId)
                ->where('DATE(jam_keluar)', date('Y-m-d'))
                ->countAllResults();
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

            $userId = $session->get('id_user');
            $userLevel = $session->get('level_user');
            $data = [
                'judul' => 'Dashboard',
                'subjudul' => 'Dashboard',
                'page' => 'user/user_dashboard_cs',
                'navbar' => 'user/template/v_navbar.php',
                'footer' => 'user/template/v_footer.php',
                'sidebar' => 'user/template/v_sidebar.php',
                'userLevel' => $userLevel,
                'countAbsenMasuk' => $countAbsenMasuk,
                'countAbsenKeluar' => $countAbsenKeluar,
                'jam' => $jamData

            ];
            // var_dump($data);
            // die;
            // Jika level_user adalah user, tampilkan view user_dashboard
            return view('user/template/temp_user', $data);
        } else {
            // Jika level_user tidak diketahui, redirect ke halaman login
            return redirect()->to('login');
        }
    }

    public function userList()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->where('level_user', 2)->orWhere('level_user', 3)->findAll();

        // Tampilkan view untuk daftar user
        return view('user_list', $data);
    }
}