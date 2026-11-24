<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['category_id', 'sku', 'name', 'slug', 'price', 'stock', 'image', 'description', 'is_active'];

    protected $validationRules = [
        'category_id' => 'required|integer',
        'sku'         => 'required|max_length[40]',
        'name'        => 'required|min_length[3]|max_length[140]',
        'price'       => 'required|integer|greater_than[0]',
        'stock'       => 'required|integer|greater_than_equal_to[0]',
    ];

    public function getCatalog(?string $categorySlug = null, string $search = ''): array
    {
        $builder = $this->db->table('products p')
            ->select('p.*, c.name AS category_name, c.slug AS category_slug')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.is_active', 1)
            ->orderBy('p.id', 'ASC');

        if ($categorySlug !== null && $categorySlug !== '') {
            $builder->where('c.slug', $categorySlug);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('p.name', $search)
                ->orLike('p.sku', $search)
                ->orLike('p.description', $search)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getAllAdmin(): array
    {
        return $this->db->table('products p')
            ->select('p.*, c.name AS category_name')
            ->join('categories c', 'c.id = p.category_id')
            ->orderBy('p.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function findBySlugWithCategory(string $slug): ?array
    {
        $row = $this->db->table('products p')
            ->select('p.*, c.name AS category_name, c.slug AS category_slug')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.slug', $slug)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }
}
