<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Ambil data user dari session
        $session = session();
        $level_user = $session->get('level_user');

        if ($level_user == 1) {
            // Jika level_user adalah admin, tampilkan view admin_dashboard
            return view('admin_dashboard');
        } elseif ($level_user == 2) {
            // Jika level_user adalah user, tampilkan view user_dashboard
            return view('user_dashboard');
        } else {
            // Jika level_user tidak diketahui, redirect ke halaman login
            return redirect()->to('login');
        }
    }
}