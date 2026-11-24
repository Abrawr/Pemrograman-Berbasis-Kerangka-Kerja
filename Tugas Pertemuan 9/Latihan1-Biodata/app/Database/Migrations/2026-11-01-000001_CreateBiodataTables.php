<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiodataTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'admin'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'      => ['type' => 'VARCHAR', 'constraint' => 150],
            'kategori'   => ['type' => 'VARCHAR', 'constraint' => 60],
            'modul_pbkk' => ['type' => 'VARCHAR', 'constraint' => 40],
            'isi'        => ['type' => 'TEXT'],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 25, 'default' => 'Selesai'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('catatan', true);

        $this->forge->addField([
            'id'            => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'         => ['type' => 'VARCHAR', 'constraint' => 120],
            'nama_file'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_asli'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'mime_type'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'ukuran_kb'     => ['type' => 'INTEGER', 'constraint' => 11, 'default' => 0],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('berkas_upload', true);
    }

    public function down()
    {
        $this->forge->dropTable('berkas_upload', true);
        $this->forge->dropTable('catatan', true);
        $this->forge->dropTable('users', true);
    }
}
