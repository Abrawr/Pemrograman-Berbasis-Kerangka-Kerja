<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'category_id',
        'sku',
        'name',
        'slug',
        'price',
        'original_price',
        'stock',
        'status',
        'short_desc',
        'description',
        'featured',
    ];

    protected $validationRules = [
        'category_id' => 'required|integer',
        'sku'         => 'required|min_length[3]|max_length[50]',
        'name'        => 'required|min_length[3]|max_length[150]',
        'price'       => 'required|integer|greater_than[0]',
        'stock'       => 'required|integer|greater_than_equal_to[0]',
        'status'      => 'required|in_list[tersedia,tidak_tersedia]',
    ];

    private function attachPrimaryImages(array $rows): array
    {
        if (empty($rows)) {
            return $rows;
        }

        $ids = array_map(static fn (array $r): int => (int) $r['id'], $rows);
        $images = $this->db->table('product_images')
            ->whereIn('product_id', $ids)
            ->orderBy('is_primary', 'DESC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        $primaryByProduct = [];
        foreach ($images as $img) {
            $pid = (int) $img['product_id'];
            if (! isset($primaryByProduct[$pid])) {
                $primaryByProduct[$pid] = $img['image_path'];
            }
        }

        foreach ($rows as &$row) {
            $pid          = (int) $row['id'];
            $row['image'] = $primaryByProduct[$pid] ?? 'assets/images/products/headphone-bluetooth-studio.svg';
        }

        return $rows;
    }

    public function getAdminProducts(array $filters, int $perPage = 8): array
    {
        $this->select('products.*, categories.name AS category_name, categories.slug AS category_slug')
            ->join('categories', 'categories.id = products.category_id')
            ->orderBy('products.id', 'DESC');

        if (! empty($filters['q'])) {
            $term = trim((string) $filters['q']);
            $this->groupStart()
                ->like('products.name', $term, 'both', null, true)
                ->orLike('products.sku', $term, 'both', null, true)
                ->groupEnd();
        }

        if (! empty($filters['category_id'])) {
            $this->where('products.category_id', (int) $filters['category_id']);
        }

        if (! empty($filters['status'])) {
            $this->where('products.status', (string) $filters['status']);
        }

        return $this->attachPrimaryImages($this->paginate($perPage));
    }

    public function getPublicCatalog(array $filters): array
    {
        $builder = $this->db->table('products')
            ->select('products.*, categories.name AS category_name, categories.slug AS category_slug')
            ->join('categories', 'categories.id = products.category_id');

        if (! empty($filters['category'])) {
            $builder->where('categories.slug', (string) $filters['category']);
        }

        if (! empty($filters['q'])) {
            $term = trim((string) $filters['q']);
            $builder->groupStart()
                ->like('products.name', $term, 'both', null, true)
                ->orLike('products.sku', $term, 'both', null, true)
                ->orLike('products.short_desc', $term, 'both', null, true)
                ->groupEnd();
        }

        $sort = $filters['sort'] ?? 'featured';
        match ($sort) {
            'price_asc'  => $builder->orderBy('products.price', 'ASC'),
            'price_desc' => $builder->orderBy('products.price', 'DESC'),
            'name_asc'   => $builder->orderBy('products.name', 'ASC'),
            default      => $builder->orderBy('products.featured', 'DESC')->orderBy('products.id', 'DESC'),
        };

        return $this->attachPrimaryImages($builder->get()->getResultArray());
    }

    public function findBySlugWithDetails(string $slug): ?array
    {
        $row = $this->db->table('products')
            ->select('products.*, categories.name AS category_name, categories.slug AS category_slug')
            ->join('categories', 'categories.id = products.category_id')
            ->where('products.slug', $slug)
            ->get()
            ->getRowArray();

        if (! $row) {
            return null;
        }

        $images = (new ProductImageModel())->getByProduct((int) $row['id']);
        $row['images'] = $images;
        $row['image']  = $images[0]['image_path'] ?? 'assets/images/products/headphone-bluetooth-studio.svg';

        return $row;
    }

    public function getInventoryList(string $mode = 'all'): array
    {
        $builder = $this->db->table('products')
            ->select('products.*, categories.name AS category_name')
            ->join('categories', 'categories.id = products.category_id');

        if ($mode === 'low') {
            $builder->where('products.stock >', 0)->where('products.stock <=', 5);
        } elseif ($mode === 'out') {
            $builder->where('products.stock <=', 0);
        }

        return $builder->orderBy('products.stock', 'ASC')
            ->orderBy('products.id', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getDashboardStats(): array
    {
        $totalProducts  = $this->db->table('products')->countAllResults();
        $totalCategories = $this->db->table('categories')->countAllResults();
        $available      = $this->db->table('products')->where('status', 'tersedia')->countAllResults();
        $unavailable    = $this->db->table('products')->where('status', 'tidak_tersedia')->countAllResults();
        $lowStock       = $this->db->table('products')->where('stock >', 0)->where('stock <=', 5)->countAllResults();
        $outOfStock     = $this->db->table('products')->where('stock <=', 0)->countAllResults();

        return [
            'total_products'   => $totalProducts,
            'total_categories' => $totalCategories,
            'available'        => $available,
            'unavailable'      => $unavailable,
            'low_stock'        => $lowStock,
            'out_of_stock'     => $outOfStock,
        ];
    }
}
