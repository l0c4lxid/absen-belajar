<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Devisi extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_devisi' => 1,
                'keterangan' => 'TS',
            ],
            [
                'id_devisi' => 2,
                'keterangan' => 'CS',
            ],
            [
                'id_devisi' => 3,
                'keterangan' => 'SATPAM',
            ],
            [
                'id_devisi' => 4,
                'keterangan' => 'DCC',
            ],
        ];

        // Insert data ke dalam tabel devisi
        $this->db->table('tbl_devisi')->insertBatch($data);
    }
}
