<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_devisi', 'username', 'password', 'level_user', 'nama', 'alamat', 'no_telp', 'devisi'];

    public function getUsersWithDevisi()
    {
        $this->select('tbl_user.*, tbl_devisi.keterangan');
        $this->join('tbl_devisi', 'tbl_devisi.id_devisi = tbl_user.id_devisi');
        return $this->where('level_user', 2)->findAll();
    }
}