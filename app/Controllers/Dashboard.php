<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\DevisiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
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
            $jumlahPegawai = $pegawaiModel->where('level_user', 2)->countAllResults();

            $currentDate = date('Y-m-d');

            // Menghitung jumlah absen masuk pada hari ini
            $jumlahAbsenMasuk = $absenModel->where('keterangan', 'Masuk')
                ->orWhere('keterangan', 'Keluar')
                ->where('DATE(jam_masuk)', $currentDate)
                ->countAllResults();

            // Menghitung jumlah absen keluar pada hari ini
            $jumlahAbsenKeluar = $absenModel->where('keterangan', 'Keluar')
                ->where('DATE(jam_keluar)', $currentDate)
                ->countAllResults();

            // Menghitung jumlah pegawai yang belum absen masuk pada hari ini
            $jumlahPegawaiBelumAbsenMasuk = $jumlahPegawai - $jumlahAbsenMasuk;

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
            $data = [
                'judul' => 'Dashboard',
                'subjudul' => 'Dashboard',
                'page' => 'user/user_dashboard',
                'navbar' => 'user/template/v_navbar.php',
                'footer' => 'user/template/v_footer.php',
                'sidebar' => 'user/template/v_sidebar.php',
            ];
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
        $data['users'] = $userModel->where('level_user', 2)->findAll();

        // Tampilkan view untuk daftar user
        return view('user_list', $data);
    }
}