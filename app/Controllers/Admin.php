<?php
namespace App\Controllers;

use App\Models\DevisiModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'admin/v_dashboard.php',
            'navbar' => 'admin/v_navbar.php',
            'footer' => 'admin/v_footer.php',
            'sidebar' => 'admin/v_sidebar.php',
        ];
        // Tampilkan view untuk dashboard admin
        return view('admin/temp_admin', $data);
    }

    public function addUser()
    {
        $data = [
            'judul' => 'Tambah Pekerja Magang',
            'subjudul' => 'tambah-magang',
            'page' => 'admin/add_user',
            'navbar' => 'admin/v_navbar.php',
            'footer' => 'admin/v_footer.php',
            'sidebar' => 'admin/v_sidebar.php',
        ];
        // Tampilkan view untuk menambahkan user baru
        return view('admin/temp_admin', $data);
    }

    public function saveUser()
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $devisi = $this->request->getPost('devisi');

        // Cek apakah username sudah ada di database
        $existingUser = $userModel->where('username', $username)->first();

        if ($existingUser) {
            // Jika username sudah ada, tampilkan pesan error
            $session = session();
            $session->setFlashdata('error', '<div class="card card-warning shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Username Telah Ada !!!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
            return redirect()->to('admin/add_user');
        }

        // Jika username belum ada, lanjutkan untuk menyimpan user baru
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level_user' => 2,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'devisi' => $devisi,
        ];
        $userModel->insert($data);

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah user
        $session = session();
        $session->setFlashdata('success', 'User added successfully.');
        return redirect()->to('admin/add_user');
    }

    public function listDevisi()
    {
        $userModel = new UserModel();

        // Ambil data user dengan level_user 2 dari database
        $users = $userModel->where('level_user', 2)->findAll();

        // Prepare the data for the view
        $data = [
            'judul' => 'Tambah Pekerja Magang',
            'subjudul' => 'data-magang',
            'page' => 'admin/data_magang',
            'navbar' => 'admin/v_navbar.php',
            'footer' => 'admin/v_footer.php',
            'sidebar' => 'admin/v_sidebar.php',
            'users' => $users, // Add the $users data to the $data array
        ];
        // Tampilkan view untuk menampilkan data user level_user 2
        return view('admin/temp_admin', $data);
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
            return redirect()->to('admin/listDevisi')->with('error', 'You do not have permission to edit this user.');
        }
    }

    public function updateUser($id_user)
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $devisi = $this->request->getPost('devisi');

        // Update data user berdasarkan id_user
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'devisi' => $devisi,
        ];
        $userModel->update($id_user, $data);

        // Redirect kembali ke halaman list user level 2 dengan notifikasi
        return redirect()->to('admin/listDevisi')->with('success', 'User updated successfully.');
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
            return redirect()->to('admin/listDevisi')->with('success', 'User deleted successfully.');
        } else {
            // Redirect ke halaman lain jika user tidak memiliki akses untuk menghapus
            return redirect()->to('admin/listDevisi')->with('error', 'You do not have permission to delete this user.');
        }
    }
    // public function addDivision()
    // {
    //     // Tampilkan halaman tambah divisi
    //     return view('add_division');
    // }

    // public function saveDivision()
    // {
    //     $divisionModel = new DevisiModel();

    //     // Ambil data dari form
    //     $divisionName = $this->request->getPost('devisi');

    //     // Simpan data divisi ke dalam database
    //     $data = [
    //         'devisi' => $divisionName
    //         // Tambahkan kolom lain sesuai kebutuhan
    //     ];
    //     $divisionModel->insert($data);

    //     // Tampilkan notifikasi dan redirect kembali ke halaman tambah divisi
    //     $session = session();
    //     $session->setFlashdata('success', 'Division added successfully.');
    //     return redirect()->to('admin/add_division');
    // }
    // public function listDivision()
    // {
    //     $divisionModel = new DevisiModel();

    //     // Ambil data semua divisi dari database
    //     $divisions = $divisionModel->findAll();

    //     $data['divisions'] = $divisions;

    //     // Tampilkan view untuk menampilkan daftar divisi
    //     return view('list_division', $data);
    // }

    // public function deleteDivision($id_devisi)
    // {
    //     $divisionModel = new DevisiModel();

    //     // Hapus divisi berdasarkan id_$id_devisi
    //     $divisionModel->delete($id_devisi);

    //     // Redirect kembali ke halaman list divisi dengan notifikasi
    //     return redirect()->to('admin/list_division')->with('success', 'Division deleted successfully.');
    // }
}