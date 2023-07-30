<?php
namespace App\Models;

use CodeIgniter\Model;

class DevisiModel extends Model
{
    protected $table = 'tbl_devisi';
    protected $primaryKey = 'id_devisi';
    protected $allowedFields = ['keterangan'];
}