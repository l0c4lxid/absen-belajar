<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JamModel;

class Jam extends BaseController
{
    public function index()
    {
        // Fetch time schedules from the database
        $jamModel = new JamModel();
        $schedules = $jamModel->where('id_jam >', 0)->findAll();
        $cs = $jamModel->where('id_jam =', 0)->findAll();

        // Ambil data semua jam dari database
        $data = [
            'schedules' => $schedules,
            'cs' => $cs,
            'judul' => 'Pengaturan Jadwal',
            'subjudul' => 'Jam',
            'page' => 'admin/jam',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ];

        // Jika tidak ada data waktu, atur 'schedules' menjadi null
        if (empty($schedules)) {
            $data['schedules'] = null;
        }

        // Load the view to display time schedules
        return view('admin/template/temp_admin', $data);
    }
    public function savejam()
    {
        $jamModel = new JamModel();

        // Ambil data dari form
        $shift = $this->request->getPost('shift');
        $jam_masuk_awal = $this->request->getPost('jam_masuk_awal');
        $jam_masuk_akhir = $this->request->getPost('jam_masuk_akhir');
        $jam_keluar_awal = $this->request->getPost('jam_keluar_awal');
        $jam_keluar_akhir = $this->request->getPost('jam_keluar_akhir');

        // Cek apakah data jam sudah ada di database
        $existingJam = $jamModel->where('shift', $shift)->first();
        if ($existingJam) {
            // Jika data sudah ada, tampilkan pesan error
            $session = session();
            $session->setFlashdata('error', '<div class="card card-warning shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Nama Sudah Ada !!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
            return redirect()->to('jadwal');
        }

        // Simpan data jam ke dalam database
        $data = [
            'shift' => $shift,
            'jam_masuk_awal' => $jam_masuk_awal,
            'jam_masuk_akhir' => $jam_masuk_akhir,
            'jam_keluar_awal' => $jam_keluar_awal,
            'jam_keluar_akhir' => $jam_keluar_akhir
            // Tambahkan kolom lain sesuai kebutuhan
        ];
        $jamModel->insert($data);

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah jam
        $session = session();
        $session->setFlashdata('success', '<div class="row">
        <div class="col-md-12">
            <div class="card card-success shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Jam Berhasil Ditambahkan.</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>');
        return redirect()->to('jadwal');
    }

    public function updatejam($id_jam)
    {
        $jamModel = new JamModel();

        // Ambil data dari form
        $shift = $this->request->getPost('shift');
        $jam_masuk_awal = $this->request->getPost('jam_masuk_awal');
        $jam_masuk_akhir = $this->request->getPost('jam_masuk_akhir');
        $jam_keluar_awal = $this->request->getPost('jam_keluar_awal');
        $jam_keluar_akhir = $this->request->getPost('jam_keluar_akhir');

        $data = [
            'shift' => $shift,
            'jam_masuk_awal' => $jam_masuk_awal,
            'jam_masuk_akhir' => $jam_masuk_akhir,
            'jam_keluar_awal' => $jam_keluar_awal,
            'jam_keluar_akhir' => $jam_keluar_akhir
        ];
        $jamModel->update($id_jam, $data);

        // Tampilkan view untuk menampilkan daftar jam
        // return view('admin/temp_admin', $data);
        return redirect()->to('jadwal')->with('success', '<div class="row">
        <div class="col-md-12">
            <div class="card card-success shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Jadwal telah diganti.</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>');
    }
    public function deletejam($id_jam)
    {
        $jamModel = new JamModel();

        // Hapus jam berdasarkan id_$id_jam
        $jamModel->delete($id_jam);

        // Redirect kembali ke halaman list jam dengan notifikasi
        return redirect()->to('jadwal')->with('success', '<div class="row">
        <div class="col-md-12">
            <div class="card card-success shadow">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Jadwal telah dihapus.</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>');
    }
}
