<?php

namespace App\Models;

use CodeIgniter\Model;

class JamModel extends Model
{
    protected $table = 'tbl_jam';
    protected $primaryKey = 'id_jam';
    protected $allowedFields = ['masuk_1', 'keluar_1', 'masuk_2', 'keluar_2'];
}
