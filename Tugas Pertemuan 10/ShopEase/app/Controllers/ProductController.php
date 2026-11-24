<?php

namespace App\Controllers;

use App\Libraries\CatalogData;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductController extends BaseController
{
    public function index(): string
    {
        $search   = trim((string) $this->request->getGet('q'));
        $category = trim((string) $this->request->getGet('category'));
        $sort     = trim((string) $this->request->getGet('sort'));
        if ($sort === '') {
            $sort = 'featured';
        }

        $activeCategoryObj = $category !== '' ? CatalogData::findCategory($category) : null;
        $products          = CatalogData::filterProducts($category !== '' ? $category : null, $search, $sort);

        return view('frontend/products', [
            'title'          => $activeCategoryObj ? 'Kategori ' . $activeCategoryObj['name'] . ' — ShopEase' : 'Katalog Produk — ShopEase',
            'activeMenu'     => 'products',
            'categories'     => CatalogData::categories(),
            'products'       => $products,
            'searchQuery'    => $search,
            'activeCategory' => $category,
            'activeCatObj'   => $activeCategoryObj,
            'sort'           => $sort,
        ]);
    }

    public function category(string $slug): string
    {
        $categoryObj = CatalogData::findCategory($slug);
        if (! $categoryObj) {
            throw PageNotFoundException::forPageNotFound("Kategori \"{$slug}\" tidak ditemukan.");
        }

        $search = trim((string) $this->request->getGet('q'));
        $sort   = trim((string) $this->request->getGet('sort')) ?: 'featured';

        return view('frontend/products', [
            'title'          => $categoryObj['name'] . ' — Katalog ShopEase',
            'activeMenu'     => 'products',
            'categories'     => CatalogData::categories(),
            'products'       => CatalogData::filterProducts($slug, $search, $sort),
            'searchQuery'    => $search,
            'activeCategory' => $slug,
            'activeCatObj'   => $categoryObj,
            'sort'           => $sort,
        ]);
    }

    public function detail(string $slug): string
    {
        $product = CatalogData::findProductBySlug($slug);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound("Produk dengan slug \"{$slug}\" tidak ditemukan.");
        }

        $related = array_values(array_filter(
            CatalogData::filterProducts($product['category_slug']),
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
