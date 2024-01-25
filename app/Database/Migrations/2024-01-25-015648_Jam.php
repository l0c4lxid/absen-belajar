<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jam' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'shift' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'collate' => 'utf8mb4_general_ci',
            ],
            'jam_masuk_awal' => [
                'type' => 'TIME',
            ],
            'jam_masuk_akhir' => [
                'type' => 'TIME',
            ],
            'jam_keluar_awal' => [
                'type' => 'TIME',
            ],
            'jam_keluar_akhir' => [
                'type' => 'TIME',
            ],
        ]);

        $this->forge->addKey('id_jam', true);
        $this->forge->createTable('tbl_jam');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jam');
    }
}
