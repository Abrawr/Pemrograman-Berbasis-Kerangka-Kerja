<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'description'];

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
    ];

    public function getWithProductCount(): array
    {
        return $this->db->table('categories c')
            ->select('c.*, COUNT(p.id) AS count')
            ->join('products p', 'p.category_id = c.id', 'left')
            ->groupBy('c.id, c.name, c.slug, c.description, c.created_at, c.updated_at')
            ->orderBy('c.id', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function hasProducts(int $categoryId): int
    {
        return $this->db->table('products')
            ->where('category_id', $categoryId)
            ->countAllResults();
    }

    public function findBySlug(string $slug): ?array
    {
        $row = $this->where('slug', $slug)->first();

        return $row ?: null;
    }
}
