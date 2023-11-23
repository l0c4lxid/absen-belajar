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
                return redirect()->to('Dashboard');
            } elseif ($userLevel == 2) {
                return redirect()->to('Dashboard');
            } elseif ($userLevel == 3) {
                return redirect()->to('Dashboard');
            }
        }

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
                    'id_jam' => $user['id_jam'],
                    'logged_in' => true,
                    'last_activity' => time(), // Menyimpan waktu aktivitas terakhir
                ];
                // Atur waktu kadaluarsa sesi menjadi 1 jam (3600 detik)
                $session->set($sessionData, ['last_activity' => time() + 3600]);

                // Redirect ke halaman dashboard berdasarkan level_user setelah login berhasil
                if ($user['level_user'] == 1) {
                    return redirect()->to('Dashboard');
                } elseif ($user['level_user'] == 2) {
                    return redirect()->to('Dashboard');
                } elseif ($user['level_user'] == 3) {
                    return redirect()->to('Dashboard');
                }
            } else {
                // Login gagal, tampilkan pesan error dan kembalikan data yang dimasukkan sebelumnya
                $data['username'] = $username;
                $session->setFlashdata('error', '<div class="card card-danger">
            <div class="card-header col-md-12">
                <h3 class="card-title">Username / Password Salah !</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
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