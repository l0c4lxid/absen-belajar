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
        $schedules = $jamModel->findAll();

        // Ambil data semua divisi dari database
        $data = [
            'schedules' => $schedules,
            'judul' => 'Atur Waktu',
            'subjudul' => 'Jam',
            'page' => 'admin/jam',
            'navbar' => 'admin/template/v_navbar.php',
            'footer' => 'admin/template/v_footer.php',
            'sidebar' => 'admin/template/v_sidebar.php',
        ];
        // Load the view to display time schedules
        return view('admin/template/temp_admin', $data);

    }

    public function edit($id_jam)
    {
        // Fetch the specific time schedule from the database
        $jamModel = new JamModel();
        $data['schedule'] = $jamModel->find($id_jam);

        // Load the view to edit the time schedule
        return view('jadwal/edit', $data);
    }

    public function update($id_jam)
    {
        // Handle the form submission to update the time schedule
        // Validation and updating logic goes here

        return redirect()->to('/jadwal')->with('success', 'Time schedule updated successfully');
    }
}
