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
    public function AbsenMasuk()
    {

        $session = session();

        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }
        $data = [
            'judul' => 'Absensi Masuk',
            'subjudul' => 'absen-masuk',
            'page' => 'user/absensi/absen_masuk',
            'navbar' => 'user/template/v_navbar.php',
            'footer' => 'user/template/v_footer.php',
            'sidebar' => 'user/template/v_sidebar.php',
        ];
        // Load the view file for "absen_masuk"
        return view('user/template/temp_user', $data);
    }

    // Function to access the view for "absen keluar"
    public function AbsenKeluar()
    {
        $session = session();
        $data = [
            'judul' => 'Absensi Keluar',
            'subjudul' => 'absen-keluar',
            'page' => 'user/absensi/absen_keluar',
            'navbar' => 'user/template/v_navbar.php',
            'footer' => 'user/template/v_footer.php',
            'sidebar' => 'user/template/v_sidebar.php',
        ];
        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }

        // Load the view file for "absen_keluar"
        return view('user/template/temp_user', $data);
    }


    public function absen_masuk()
    {
        $session = session();

        // Pastikan user telah login dan sesi telah berisi data user dengan level_user
        if (!$session->has('id_user')) {
            return redirect()->to(base_url());
        }

        $userId = $session->get('id_user');

        // Check if the user has already done "absen masuk" today
        $today = date('Y-m-d');
        $lastAbsenMasukDate = $session->get('last_absen_masuk_date');

        if ($lastAbsenMasukDate === $today) {
            // User has already done "absen masuk" today
            $session->setFlashdata('error_message', 'Anda telah melakukan absen masuk hari ini!');
            return redirect()->to(base_url('absensi'));
        }

        $data = [
            'id_user' => $userId,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'keterangan' => 'Masuk',
        ];

        // Simpan data absen masuk
        $this->absenModel->save($data);

        // Update last_absen_masuk_date in session
        $session->set('last_absen_masuk_date', $today);

        // Set flash data to show success message in the next request
        $session->setFlashdata('success_message', 'Absen masuk berhasil!');

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

        // Check if the user has already done "absen masuk" today
        $today = date('Y-m-d');
        $lastAbsenMasukDate = $session->get('last_absen_masuk_date');

        if ($lastAbsenMasukDate !== $today) {
            // User hasn't done "absen masuk" today, can't do "absen keluar"
            $session->setFlashdata('error_message', 'Anda belum melakukan absen masuk hari ini!');
            return redirect()->to(base_url());
        }

        // Check if the user has already done "absen keluar" today
        $absenMasukToday = $this->absenModel->where('id_user', $userId)
            ->where('jam_keluar', null)
            ->where('DATE(jam_masuk)', $today)
            ->first();

        if (!$absenMasukToday) {
            // User hasn't done "absen masuk" today, can't do "absen keluar"
            $session->setFlashdata('error_message', 'Anda belum melakukan absen masuk hari ini!');
            return redirect()->to(base_url('absensi'));
        }

        // Check if the user has already done "absen keluar" today
        if ($absenMasukToday['jam_keluar']) {
            // User has already done "absen keluar" today
            $session->setFlashdata('error_message', 'Anda telah melakukan absen keluar hari ini!');
            return redirect()->to(base_url('absensi'));
        }

        $data = [
            'jam_keluar' => date('Y-m-d H:i:s'),
            'keterangan' => 'Keluar',
        ];

        // Simpan data absen keluar
        $this->absenModel->where('id_user', $userId)
            ->where('jam_keluar', null)
            ->set($data)
            ->update();
        return redirect()->to(base_url('absensi'));
    }
}