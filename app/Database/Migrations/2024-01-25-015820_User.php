<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_devisi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_jam' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'collate' => 'utf8mb4_general_ci',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'collate' => 'utf8mb4_general_ci',
            ],
            'level_user' => [
                'type' => 'ENUM',
                'constraint' => ['1', '2', '3'],
                'collate' => 'utf8mb4_general_ci',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'collate' => 'utf8mb4_general_ci',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'collate' => 'utf8mb4_general_ci',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'collate' => 'utf8mb4_general_ci',
            ],
        ]);

        $this->forge->addKey('id_user', true);
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
