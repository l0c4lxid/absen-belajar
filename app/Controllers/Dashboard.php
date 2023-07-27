<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Ambil data user dari session
        $session = session();
        $level_user = $session->get('level_user');

        if ($level_user == 1) {
            $data = [
                'judul' => 'Dashboard',
                'subjudul' => 'Dashboard',
                'page' => 'admin/v_dashboard.php',
                'navbar' => 'admin/template/v_navbar.php',
                'footer' => 'admin/template/v_footer.php',
                'sidebar' => 'admin/template/v_sidebar.php',
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