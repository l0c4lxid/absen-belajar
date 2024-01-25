<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    { {
            $data = [
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_BCRYPT), // Ganti dengan password yang diinginkan
                'level_user' => '1',
                'nama' => 'Administrator',
                'alamat' => 'Alamat Admin',
                'no_telp' => '123456789',
            ];

            // Insert data ke dalam tabel tbl_user
            $this->db->table('tbl_user')->insert($data);
        }
    }
}
