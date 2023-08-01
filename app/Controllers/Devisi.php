<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevisiModel;

class Devisi extends BaseController
{
    public function TambahDevisi()
    {
        $devisiModel = new DevisiModel();

        // Ambil data semua divisi dari database
        $devisi = $devisiModel->findAll();
        $data = [
            'devisi' => $devisi,
            'judul' => 'Tambah Devisi',
            'subjudul' => 'tambah-devisi',
            'page' => 'admin/tambah_devisi',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ];
        // Tampilkan halaman tambah divisi
        return view('admin/template/temp_admin', $data);
    }

    public function saveDivision()
    {
        $divisionModel = new DevisiModel();

        // Ambil data dari form
        $divisionName = $this->request->getPost('keterangan');

        // Cek apakah data divisi sudah ada di database
        $existingDivision = $divisionModel->where('keterangan', $divisionName)->first();
        if ($existingDivision) {
            // Jika data sudah ada, tampilkan pesan error
            $session = session();
            $session->setFlashdata('error', '<div class="card card-warning shadow">
            <div class="card-header col-md-12">
                <h3 class="card-title">Divisi Sudah Ada !!</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
        </div>');
            return redirect()->to('devisi/TambahDevisi');
        }

        // Simpan data divisi ke dalam database
        $data = [
            'keterangan' => $divisionName
            // Tambahkan kolom lain sesuai kebutuhan
        ];
        $divisionModel->insert($data);

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah divisi
        $session = session();
        $session->setFlashdata('success', '<div class="card card-success shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Divisi Berhasil Ditambahkan.</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
        return redirect()->to('devisi/TambahDevisi');
    }

    public function updateDevisi($id_user)
    {
        $devisiModel = new DevisiModel();

        // Ambil data semua divisi dari form
        $devisi = $this->request->getPost('keterangan');

        // $data['divisions'] = $divisions;
        $data = [
            'keterangan' => $devisi,
        ];
        $devisiModel->update($id_user, $data);

        // Tampilkan view untuk menampilkan daftar divisi
        // return view('admin/temp_admin', $data);
        return redirect()->to('devisi/TambahDevisi')->with('success', '<div class="card card-warning shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Devisi Telah Diganti</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>');
    }

    public function deleteDivision($id_devisi)
    {
        $divisionModel = new DevisiModel();

        // Hapus divisi berdasarkan id_$id_devisi
        $divisionModel->delete($id_devisi);

        // Redirect kembali ke halaman list divisi dengan notifikasi
        return redirect()->to('devisi/TambahDevisi')->with('success', '<div class="card card-danger shadow">
        <div class="card-header col-md-12">
            <h3 class="card-title">Devisi Telah Dihapus.</h3>
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