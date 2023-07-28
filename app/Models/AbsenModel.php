<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table = 'tbl_absen';
    protected $primaryKey = 'id_absen';
    protected $allowedFields = ['id_user', 'jam_masuk', 'jam_keluar', 'keterangan'];
    public function getAbsenByUserId($id_user, $bulan = null, $tahun = null)
    {
        $builder = $this->where('id_user', $id_user);

        // Perform filtering based on bulan and tahun if they are provided
        if ($bulan !== null && $tahun !== null) {
            $builder->where('MONTH(jam_keluar)', $bulan);
            $builder->where('YEAR(jam_keluar)', $tahun);
        }

        return $builder->findAll();
    }
}