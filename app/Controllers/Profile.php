<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function admin()
    {
        $session = session();
        $userUsername = $session->get('username');
        // Tampilkan view untuk pengaturan profil admin
        return view('admin/template/temp_admin', [
            'userUsername' => $userUsername,
            'judul' => 'Ubah Profile Admin',
            'subjudul' => 'ubah-profile',
            'page' => 'admin/admin_profile',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ]);
    }

    public function user()
    {
        $session = session();
        $userUsername = $session->get('username');

        // Tampilkan view untuk pengaturan profil user
        return view('user/template/temp_user', [
            'userUsername' => $userUsername,
            'judul' => 'Ubah Profile User',
            'subjudul' => 'ubah-profile',
            'page' => 'user/user_profile',
            'navbar' => 'user/template/v_navbar.php',
            'footer' => 'user/template/v_footer.php',
            'sidebar' => 'user/template/v_sidebar.php',
        ]);
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