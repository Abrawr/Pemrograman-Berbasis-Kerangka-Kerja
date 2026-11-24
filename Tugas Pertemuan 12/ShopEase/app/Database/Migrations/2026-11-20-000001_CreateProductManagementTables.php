<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductManagementTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 110, 'unique' => true],
            'description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories', true);

        $this->forge->addField([
            'id'             => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'    => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'sku'            => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'name'           => ['type' => 'VARCHAR', 'constraint' => 150],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 160, 'unique' => true],
            'price'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'original_price' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'stock'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'tersedia'],
            'short_desc'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'    => ['type' => 'TEXT', 'null' => true],
            'featured'       => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 0],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('products', true);

        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_primary' => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 0],
            'sort_order' => ['type' => 'INTEGER', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_images', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_images', true);
        $this->forge->dropTable('products', true);
        $this->forge->dropTable('categories', true);
    }
}
