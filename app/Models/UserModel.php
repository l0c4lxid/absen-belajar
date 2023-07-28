<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'level_user', 'nama', 'alamat', 'no_telp', 'devisi'];
}