<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Images extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'caption' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'owner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'date',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'date',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id');
        $this->forge->createTable('images');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('images');
    }
}