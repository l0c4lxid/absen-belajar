<?php

namespace App\Models;

use CodeIgniter\Model;

class JamModel extends Model
{
    protected $table = 'tbl_jam';
    protected $primaryKey = 'id_jam';
    protected $allowedFields = ['shift', 'jam_masuk_awal', 'jam_masuk_akhir', 'jam_keluar_awal', 'jam_keluar_akhir'];
}
