<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiakadTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nidn'       => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 120],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 120],
            'keahlian'   => ['type' => 'VARCHAR', 'constraint' => 120],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dosen', true);

        $this->forge->addField([
            'id'            => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nrp'           => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama'          => ['type' => 'VARCHAR', 'constraint' => 120],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 120],
            'angkatan'      => ['type' => 'INTEGER', 'constraint' => 4, 'default' => 2024],
            'prodi'         => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Teknik Informatika'],
            'dosen_wali_id' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status'        => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'Aktif'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dosen_wali_id', 'dosen', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('mahasiswa', true);

        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode'       => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 120],
            'sks'        => ['type' => 'INTEGER', 'constraint' => 2],
            'semester'   => ['type' => 'INTEGER', 'constraint' => 2],
            'dosen_id'   => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dosen_id', 'dosen', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('mata_kuliah', true);

        $this->forge->addField([
            'id'             => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'mahasiswa_id'   => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'mata_kuliah_id' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'tahun_ajaran'   => ['type' => 'VARCHAR', 'constraint' => 25, 'default' => '2026/2027-Ganjil'],
            'nilai_huruf'    => ['type' => 'VARCHAR', 'constraint' => 3, 'null' => true],
            'nilai_angka'    => ['type' => 'DECIMAL', 'constraint' => '3,2', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['mahasiswa_id', 'mata_kuliah_id', 'tahun_ajaran']);
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mata_kuliah_id', 'mata_kuliah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('krs', true);
    }

    public function down()
    {
        $this->forge->dropTable('krs', true);
        $this->forge->dropTable('mata_kuliah', true);
        $this->forge->dropTable('mahasiswa', true);
        $this->forge->dropTable('dosen', true);
    }
}
