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
        $divisionName = $this->request->getPost('devisi');

        // Simpan data divisi ke dalam database
        $data = [
            'devisi' => $divisionName
            // Tambahkan kolom lain sesuai kebutuhan
        ];
        $divisionModel->insert($data);

        // Tampilkan notifikasi dan redirect kembali ke halaman tambah divisi
        $session = session();
        $session->setFlashdata('pesan', 'Division added successfully.');
        return redirect()->to('devisi/adddivision');
    }
    public function updateDevisi($id_user)
    {
        $devisiModel = new DevisiModel();

        // Ambil data semua divisi dari form
        $devisi = $this->request->getPost('devisi');

        // $data['divisions'] = $divisions;
        $data = [
            'devisi' => $devisi,
        ];
        $devisiModel->update($id_user, $data);

        // Tampilkan view untuk menampilkan daftar divisi
        // return view('admin/temp_admin', $data);
        return redirect()->to('devisi/addDivision')->with('pesan', 'User updated successfully.');
    }

    public function deleteDivision($id_devisi)
    {
        $divisionModel = new DevisiModel();

        // Hapus divisi berdasarkan id_$id_devisi
        $divisionModel->delete($id_devisi);

        // Redirect kembali ke halaman list divisi dengan notifikasi
        return redirect()->to('devisi/addDivision')->with('hapus', 'Division deleted successfully.');
    }
}