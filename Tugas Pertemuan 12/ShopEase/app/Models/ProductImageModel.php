<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table         = 'product_images';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['product_id', 'image_path', 'is_primary', 'sort_order', 'created_at'];

    public function getByProduct(int $productId): array
    {
        return $this->where('product_id', $productId)
            ->orderBy('is_primary', 'DESC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function setPrimary(int $productId, int $imageId): bool
    {
        $target = $this->where('id', $imageId)->where('product_id', $productId)->first();
        if (! $target) {
            return false;
        }

        $this->where('product_id', $productId)->set(['is_primary' => 0])->update();
        $this->update($imageId, ['is_primary' => 1]);

        return true;
    }

    public function deleteWithFallback(int $productId, int $imageId): bool
    {
        $image = $this->where('id', $imageId)->where('product_id', $productId)->first();
        if (! $image) {
            return false;
        }

        // Hanya hapus file fisik jika tersimpan di folder uploads/products/ (jangan hapus SVG katalog bersama)
        $relPath = str_replace('\\', '/', (string) $image['image_path']);
        if (str_starts_with($relPath, 'uploads/products/')) {
            $absPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $relPath);
            if (is_file($absPath)) {
                @unlink($absPath);
            }
        }

        $wasPrimary = (int) $image['is_primary'] === 1;
        $this->delete($imageId);

        if ($wasPrimary) {
            $next = $this->where('product_id', $productId)
                ->orderBy('sort_order', 'ASC')
                ->orderBy('id', 'ASC')
                ->first();
            if ($next) {
                $this->update((int) $next['id'], ['is_primary' => 1]);
            }
        }

        return true;
    }
}
