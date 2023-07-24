<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();

        // Cek apakah pengguna sudah login, jika ya, redirect ke halaman dashboard
        if ($session->get('logged_in')) {
            return redirect()->to('dashboard');
        }

        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil, simpan data user ke session
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'level_user' => $user['level_user'],
                    'logged_in' => true,
                ];
                $session->set($sessionData);

                // Redirect ke halaman dashboard berdasarkan level_user
                return redirect()->to('dashboard');
            } else {
                // Login gagal, tampilkan pesan error
                echo 'Username or password is incorrect.';
            }
        }

        return view('login');
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}