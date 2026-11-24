<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'            => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true],
            'password'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone'           => ['type' => 'VARCHAR', 'constraint' => 25, 'null' => true],
            'role'            => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'customer'],
            'is_active'       => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
            'failed_attempts' => ['type' => 'INTEGER', 'constraint' => 3, 'default' => 0],
            'locked_until'    => ['type' => 'DATETIME', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
