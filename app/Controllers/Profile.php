<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function admin()
    {
        $session = session();
        $userUsername = $session->get('username');
        // $data = [
        //     'judul' => 'Ubah Profile Admin',
        //     'subjudul' => 'ubah-profile',
        //     'page' => 'admin/admin_profile',
        //     'navbar' => 'admin/v_navbar.php',
        //     'footer' => 'admin/v_footer.php',
        //     'sidebar' => 'admin/v_sidebar.php',
        // ];

        // Tampilkan view untuk pengaturan profil admin
        return view('admin/temp_admin', [
            'userUsername' => $userUsername,
            'judul' => 'Ubah Profile Admin',
            'subjudul' => 'ubah-profile',
            'page' => 'admin/admin_profile',
            'navbar' => 'admin/v_navbar.php',
            'footer' => 'admin/v_footer.php',
            'sidebar' => 'admin/v_sidebar.php',
        ]);
    }

    public function user()
    {
        $session = session();
        $userUsername = $session->get('username');

        // Tampilkan view untuk pengaturan profil user
        return view('user_profile', ['userUsername' => $userUsername]);
    }
    public function save_admin()
    {
        $session = session();
        $userId = $session->get('user_id');
        $newUsername = $this->request->getPost('username');
        $newPassword = $this->request->getPost('password');

        // Pastikan untuk menghash password sebelum menyimpannya ke database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Lakukan proses update data di database
        $userModel = new UserModel();
        $userModel->update($userId, [
            'username' => $newUsername,
            'password' => $hashedPassword,
        ]);
        // Setelah berhasil disimpan, tampilkan pesan sukses atau lakukan redirect
        $session = session();
        $session->setFlashdata('success', 'Admin profile updated successfully.');
        return redirect()->to('profile/admin');
    }

    public function save_user()
    {
        $session = session();
        $userId = $session->get('user_id');
        $newUsername = $this->request->getPost('username');
        $newPassword = $this->request->getPost('password');

        // Pastikan untuk menghash password sebelum menyimpannya ke database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Lakukan proses update data di database
        $userModel = new UserModel();
        $userModel->update($userId, [
            'username' => $newUsername,
            'password' => $hashedPassword,
        ]);

        // Setelah berhasil disimpan, tampilkan pesan sukses atau lakukan redirect
        $session = session();
        $session->setFlashdata('success', 'User profile updated successfully.');
        return redirect()->to('profile/user');
    }


}