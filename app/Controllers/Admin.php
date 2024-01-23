<?php
namespace App\Controllers;

use App\Models\JamModel;
use App\Models\UserModel;
use App\Models\DevisiModel;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'admin/v_dashboard.php',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ];
        // Tampilkan view untuk dashboard admin
        return view('admin/template/temp_admin', $data);
    }
    public function SemuaUser()
    {
        $userModel = new UserModel();

        // Ambil data user dengan level_user 2 beserta relasi devisi dari database
        $users = $userModel->getUsersWithDevisiJam();

        // Prepare the data for the view
        $data = [
            'judul' => 'Tambah Pekerja',
            'subjudul' => 'data-magang',
            'page' => 'admin/data_magang',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
            'users' => $users,
            // Add the $users data to the $data array
        ];
        // Tampilkan view untuk menampilkan data user level_user 2
        return view('admin/template/temp_admin', $data);
    }
    public function TambahUser()
    {
        $data = [
            'judul' => 'Tambah Pekerja',
            'subjudul' => 'data-magang',
            'page' => 'admin/tambah_user',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ];
        // Tampilkan view untuk menambahkan user baru
        return view('admin/template/temp_admin', $data);
    }

    public function saveUser()
    {
        $userModel = new UserModel();
        $devisiModel = new DevisiModel();
        $jamModel = new JamModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $id_devisi = $this->request->getPost('id_devisi'); // Ambil nilai id_devisi dari form
        $id_jam = $this->request->getPost('id_jam'); // Ambil nilai id_jam dari form


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
            return redirect()->to('admin/SemuaUser');
        }

        // Jika username belum ada, lanjutkan untuk menyimpan user baru
        $devisi = $devisiModel->find($id_devisi); // Ambil data devisi berdasarkan id_devisi
        if (!$devisi) {
            // Jika id_devisi tidak valid (tidak ada di tabel devisi), mungkin ada kesalahan
            // Tampilkan pesan error atau lakukan penanganan sesuai kebutuhan
            return redirect()->to('admin/SemuaUser')->with('error', 'Devisi tidak valid.');
        }

        // Set the default 'level_user' to 2
        $level_user = 2;

        // Check if the 'keterangan' is 'cs' or '' and set 'level_user' to 3
        if ($devisi['keterangan'] === 'CS') {
            $level_user = 3;
            // Set $id_jam to 0 if 'keterangan' is 'CS'
            $id_jam = 0;
        } else {
            // Check if id_jam exists in tbl_jam
            $jam = $jamModel->find($id_jam);
            if (!$jam) {
                // If id_jam is not valid, display an error or handle it as needed
                return redirect()->to('admin/SemuaUser')->with('error', 'Jam tidak valid.');
            }
        }

        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level_user' => $level_user,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id_devisi' => $id_devisi,
            'id_jam' => $id_jam,
        ];
        $userModel->insert($data);

        // var_dump($data);
        // die;

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah user
        $session = session();
        $session->setFlashdata('success', '<div class="card card-success shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Berhasil Ditambahkan!!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
        return redirect()->to('admin/SemuaUser');
    }



    public function editUser($id_user)
    {
        $userModel = new UserModel();
        $devisiModel = new DevisiModel();
        $jamModel = new JamModel();


        // Ambil data user berdasarkan id_user
        $user = $userModel->find($id_user);

        // Pastikan data user dengan level_user = 2 || 3 hanya bisa diakses oleh admin
        if ($user['level_user'] == 2 || $user['level_user'] == 3) {
            $data = [
                'judul' => 'Edit Pekerja',
                'subjudul' => 'data-magang',
                'page' => 'admin/edit_user',
                'navbar' => 'admin/template/v_navbar.php',
                'footer' => 'admin/template/v_footer.php',
                'sidebar' => 'admin/template/v_sidebar.php',
                'users' => $user,
                'jam' => $jamModel->findAll(),
                'devisiData' => $devisiModel->findAll(),
                // Mengambil data devisi untuk dropdown
            ];

            // Tampilkan view untuk mengedit data user
            return view('admin/template/temp_admin', $data);
        } else {
            // Redirect ke halaman lain jika user tidak memiliki akses untuk mengedit
            return redirect()->to('admin/SemuaUser')->with('error', 'You do not have permission to edit this user.');
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
        $jam = $this->request->getPost('id_jam');

        // Ambil data user berdasarkan id_user
        $userData = $userModel->find($id_user);

        // Update data user berdasarkan id_user
        $data = [
            'username' => $username,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id_devisi' => $devisi,
            'id_jam' => $jam,
            // Ganti 'devisi' menjadi 'id_devisi'
        ];

        // Cek apakah password dikosongkan pada form, jika tidak kosong, update password
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // Jika password dikosongkan, gunakan password yang sudah ada di database
            $data['password'] = $userData['password'];
        }

        $userModel->update($id_user, $data);

        // Redirect kembali ke halaman list user level 2 || 3 dengan notifikasi
        return redirect()->to('admin/SemuaUser')->with('success', '<div class="card card-success shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Update Data Berhasil!!</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
    }

    public function deleteUser($id_user)
    {
        $userModel = new UserModel();

        // Ambil data user berdasarkan id_user
        $user = $userModel->find($id_user);

        // Pastikan data user dengan level_user = 2 || 3hanya bisa diakses oleh admin
        if ($user['level_user'] == 2 || $user['level_user'] == 3) {
            // Hapus data user berdasarkan id_user
            $userModel->delete($id_user);

            // Redirect kembali ke halaman list user level 2 || 3 dengan notifikasi
            return redirect()->to('admin/SemuaUser')->with('success', '<div class="card card-danger shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">User Data Berhasil Dihapus!!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
        } else {
            // Redirect ke halaman lain jika user tidak memiliki akses untuk menghapus
            return redirect()->to('admin/SemuaUser')->with('error', 'You do not have permission to delete this user.');
        }
    }
}