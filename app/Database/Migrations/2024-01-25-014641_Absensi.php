<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_absen' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jam_masuk' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'masuk_telat' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'collate' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'jam_keluar' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'keluar_telat' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'collate' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'keterangan' => [
                'type' => 'ENUM',
                'constraint' => ['Masuk', 'Keluar', 'Pagi', 'Sore'],
            ],
            'berita_acara' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'collate' => 'utf8mb4_general_ci',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_absen', true);
        $this->forge->createTable('tbl_absen');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_absen');
    }
}
