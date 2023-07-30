<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $data = [
            'judul' => 'Login',
        ];
        $session = session();

        // Cek apakah pengguna sudah login, jika ya, redirect ke halaman dashboard
        if ($session->get('logged_in')) {
            $userLevel = $session->get('level_user');

            if ($userLevel == 1) {
                return redirect()->to('profile/admin');
            } elseif ($userLevel == 2) {
                return redirect()->to('profile/user');
            }
        }

        // helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil, simpan data user ke session
                $sessionData = [
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'level_user' => $user['level_user'],
                    'logged_in' => true,
                ];
                $session->set($sessionData);

                // Redirect ke halaman dashboard berdasarkan level_user setelah login berhasil
                if ($user['level_user'] == 1) {
                    return redirect()->to('Dashboard');
                } elseif ($user['level_user'] == 2) {
                    return redirect()->to('Dashboard');
                }
            } else {
                // Login gagal, tampilkan pesan error
                echo 'Username or password is incorrect.';
            }
        }

        return view('login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}