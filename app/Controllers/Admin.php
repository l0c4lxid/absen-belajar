<?php
namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        // Tampilkan view untuk dashboard admin
        return view('admin_dashboard');
    }

    public function addUser()
    {
        // Tampilkan view untuk menambahkan user baru
        return view('add_user');
    }

    public function saveUser()
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah username sudah ada di database
        $existingUser = $userModel->where('username', $username)->first();

        if ($existingUser) {
            // Jika username sudah ada, tampilkan pesan error
            $session = session();
            $session->setFlashdata('error', 'Username already exists. Please choose a different username.');
            return redirect()->to('admin/add_user');
        }

        // Jika username belum ada, lanjutkan untuk menyimpan user baru
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level_user' => 2
        ];
        $userModel->insert($data);

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah user
        $session = session();
        $session->setFlashdata('success', 'User added successfully.');
        return redirect()->to('admin/add_user');
    }

    public function listUserLevelTwo()
    {
        $userModel = new UserModel();

        // Ambil data user dengan level_user 2 dari database
        $users = $userModel->where('level_user', 2)->findAll();

        $data['users'] = $users;

        // Tampilkan view untuk menampilkan data user level_user 2
        return view('user_level_two_list', $data);
    }
    public function editUser($id_user)
    {
        $userModel = new UserModel();

        // Ambil data user berdasarkan id_user
        $user = $userModel->find($id_user);

        // Pastikan data user dengan level_user = 2 hanya bisa diakses oleh admin
        if ($user['level_user'] == 2) {
            $data['user'] = $user;

            // Tampilkan view untuk mengedit data user
            return view('edit_user', $data);
        } else {
            // Redirect ke halaman lain jika user tidak memiliki akses untuk mengedit
            return redirect()->to('admin/list_user_level_two')->with('error', 'You do not have permission to edit this user.');
        }
    }

    public function updateUser($id_user)
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Update data user berdasarkan id_user
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $userModel->update($id_user, $data);

        // Redirect kembali ke halaman list user level 2 dengan notifikasi
        return redirect()->to('admin/list_user_level_two')->with('success', 'User updated successfully.');
    }
    public function deleteUser($id_user)
    {
        $userModel = new UserModel();

        // Ambil data user berdasarkan id_user
        $user = $userModel->find($id_user);

        // Pastikan data user dengan level_user = 2 hanya bisa diakses oleh admin
        if ($user['level_user'] == 2) {
            // Hapus data user berdasarkan id_user
            $userModel->delete($id_user);

            // Redirect kembali ke halaman list user level 2 dengan notifikasi
            return redirect()->to('admin/list_user_level_two')->with('success', 'User deleted successfully.');
        } else {
            // Redirect ke halaman lain jika user tidak memiliki akses untuk menghapus
            return redirect()->to('admin/list_user_level_two')->with('error', 'You do not have permission to delete this user.');
        }
    }
}