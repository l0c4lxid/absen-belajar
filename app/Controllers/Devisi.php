<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DevisiModel;

class Devisi extends BaseController
{
    public function addDivision()
    {
        $data = [
            'judul' => 'Tambah Devisi',
            'subjudul' => 'tambah-devisi',
            'page' => 'admin/add_division',
            'navbar' => 'admin/v_navbar.php',
            'footer' => 'admin/v_footer.php',
            'sidebar' => 'admin/v_sidebar.php',
        ];
        // Tampilkan halaman tambah divisi
        return view('admin/temp_admin', $data);
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
        $session->setFlashdata('success', 'Division added successfully.');
        return redirect()->to('devisi/adddivision');
    }
    public function listDivision()
    {
        $divisionModel = new DevisiModel();

        // Ambil data semua divisi dari database
        $divisions = $divisionModel->findAll();

        $data['divisions'] = $divisions;

        // Tampilkan view untuk menampilkan daftar divisi
        return view('list_division', $data);
    }

    public function deleteDivision($id_devisi)
    {
        $divisionModel = new DevisiModel();

        // Hapus divisi berdasarkan id_$id_devisi
        $divisionModel->delete($id_devisi);

        // Redirect kembali ke halaman list divisi dengan notifikasi
        return redirect()->to('devisi/listdivision')->with('success', 'Division deleted successfully.');
    }
}