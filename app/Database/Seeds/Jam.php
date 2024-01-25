<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Jam extends Seeder
{
    public function run()
    {
        $data = [
            [
                'shift' => 'CS',
                'jam_masuk_awal' => '06:00:00',
                'jam_masuk_akhir' => '09:00:00',
                'jam_keluar_awal' => '16:30:00',
                'jam_keluar_akhir' => '21:30:00',
            ],
            [
                'shift' => 'Pagi',
                'jam_masuk_awal' => '06:00:00',
                'jam_masuk_akhir' => '07:00:00',
                'jam_keluar_awal' => '16:30:00',
                'jam_keluar_akhir' => '17:30:00',
            ],
            [
                'shift' => 'Siang',
                'jam_masuk_awal' => '14:30:00',
                'jam_masuk_akhir' => '15:00:00',
                'jam_keluar_awal' => '21:00:00',
                'jam_keluar_akhir' => '22:00:00',
            ],
            [
                'shift' => 'PKL',
                'jam_masuk_awal' => '07:00:00',
                'jam_masuk_akhir' => '08:00:00',
                'jam_keluar_awal' => '15:00:00',
                'jam_keluar_akhir' => '16:00:00',
            ],
        ];

        // Insert data ke dalam tabel tbl_jam
        $this->db->table('tbl_jam')->insertBatch($data);
    }
}
