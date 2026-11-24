<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductController extends BaseController
{
    public function index(): string
    {
        $search   = trim((string) $this->request->getGet('q'));
        $category = trim((string) $this->request->getGet('category'));
        $sort     = trim((string) $this->request->getGet('sort')) ?: 'featured';

        $catModel      = new CategoryModel();
        $categories    = $catModel->getWithProductCount();
        $activeCatObj  = $category !== '' ? $catModel->findBySlug($category) : null;
        $products      = (new ProductModel())->getPublicCatalog([
            'category' => $category,
            'q'        => $search,
            'sort'     => $sort,
        ]);

        return view('frontend/products', [
            'title'          => $activeCatObj ? 'Kategori ' . $activeCatObj['name'] . ' — ShopEase' : 'Katalog Produk — ShopEase',
            'activeMenu'     => 'products',
            'categories'     => $categories,
            'products'       => $products,
            'searchQuery'    => $search,
            'activeCategory' => $category,
            'activeCatObj'   => $activeCatObj,
            'sort'           => $sort,
            'totalAll'       => array_sum(array_column($categories, 'count')),
        ]);
    }

    public function category(string $slug): string
    {
        $catModel    = new CategoryModel();
        $categoryObj = $catModel->findBySlug($slug);
        if (! $categoryObj) {
            throw PageNotFoundException::forPageNotFound("Kategori \"{$slug}\" tidak ditemukan.");
        }

        $search     = trim((string) $this->request->getGet('q'));
        $sort       = trim((string) $this->request->getGet('sort')) ?: 'featured';
        $categories = $catModel->getWithProductCount();

        return view('frontend/products', [
            'title'          => $categoryObj['name'] . ' — Katalog ShopEase',
            'activeMenu'     => 'products',
            'categories'     => $categories,
            'products'       => (new ProductModel())->getPublicCatalog(['category' => $slug, 'q' => $search, 'sort' => $sort]),
            'searchQuery'    => $search,
            'activeCategory' => $slug,
            'activeCatObj'   => $categoryObj,
            'sort'           => $sort,
            'totalAll'       => array_sum(array_column($categories, 'count')),
        ]);
    }

    public function detail(string $slug): string
    {
        $productModel = new ProductModel();
        $product      = $productModel->findBySlugWithDetails($slug);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound("Produk dengan slug \"{$slug}\" tidak ditemukan.");
        }

        $related = array_values(array_filter(
            $productModel->getPublicCatalog(['category' => $product['category_slug']]),
            static fn (array $p): bool => $p['slug'] !== $slug
        ));

        return view('frontend/product_detail', [
            'title'      => $product['name'] . ' — ShopEase',
            'activeMenu' => 'products',
            'product'    => $product,
            'related'    => array_slice($related, 0, 3),
        ]);
    }
}
