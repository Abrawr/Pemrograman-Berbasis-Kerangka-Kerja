<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table         = 'orders';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['order_code', 'customer_name', 'customer_email', 'shipping_address', 'total_amount', 'status'];

    public function getWithItems(): array
    {
        $orders = $this->orderBy('id', 'DESC')->findAll();
        $itemTbl = $this->db->table('order_items');

        foreach ($orders as &$order) {
            $order['items'] = $itemTbl->where('order_id', $order['id'])->get()->getResultArray();
        }

        return $orders;
    }
}
