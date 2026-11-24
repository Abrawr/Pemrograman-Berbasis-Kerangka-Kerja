<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTokoOnlineTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 80],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 90, 'unique' => true],
            'description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories', true);

        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id' => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'sku'         => ['type' => 'VARCHAR', 'constraint' => 40, 'unique' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 140],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true],
            'price'       => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'stock'       => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'image'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'is_active'   => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('products', true);

        $this->forge->addField([
            'id'               => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_code'       => ['type' => 'VARCHAR', 'constraint' => 30, 'unique' => true],
            'customer_name'    => ['type' => 'VARCHAR', 'constraint' => 120],
            'customer_email'   => ['type' => 'VARCHAR', 'constraint' => 120],
            'shipping_address' => ['type' => 'TEXT'],
            'total_amount'     => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'status'           => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'Diproses'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders', true);

        $this->forge->addField([
            'id'           => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id'     => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'product_id'   => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'product_name' => ['type' => 'VARCHAR', 'constraint' => 140],
            'price'        => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'qty'          => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
            'subtotal'     => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('order_items', true);
    }

    public function down()
    {
        $this->forge->dropTable('order_items', true);
        $this->forge->dropTable('orders', true);
        $this->forge->dropTable('products', true);
        $this->forge->dropTable('categories', true);
    }
}
