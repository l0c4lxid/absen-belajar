<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_devisi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_devisi', true);
        $this->forge->createTable('tbl_devisi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_devisi');

    }
}
