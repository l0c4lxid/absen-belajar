<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_devisi', 'id_jam', 'username', 'password', 'level_user', 'nama', 'alamat', 'no_telp', ''];

    public function getUsersWithDevisiJam()
    {
        $this->select('tbl_user.*, tbl_devisi.keterangan, tbl_jam.*');
        $this->join('tbl_devisi', 'tbl_devisi.id_devisi = tbl_user.id_devisi');
        $this->join('tbl_jam', 'tbl_jam.id_jam = tbl_user.id_jam');
        $this->whereIn('tbl_user.level_user', [2, 3]); // Use whereIn for multiple values

        return $this->findAll();
    }


}