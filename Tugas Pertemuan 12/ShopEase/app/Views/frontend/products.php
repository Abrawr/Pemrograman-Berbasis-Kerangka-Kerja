<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4 mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-lg-6">
      <h1 class="h3 fw-bold mb-1">
        <?= $activeCatObj ? esc($activeCatObj['name']) : 'Katalog Produk ShopEase' ?>
      </h1>
      <p class="text-secondary small mb-0">
        <?= $activeCatObj ? esc($activeCatObj['description']) : 'Menampilkan katalog produk langsung dari database (MySQL / SQLite3).' ?>
      </p>
    </div>
    <div class="col-lg-6">
      <form action="<?= site_url('products') ?>" method="get" class="row g-2 justify-content-lg-end">
        <?php if ($activeCategory !== ''): ?>
          <input type="hidden" name="category" value="<?= esc($activeCategory) ?>">
        <?php endif; ?>
        <div class="col-sm-5">
          <input type="search" name="q" value="<?= esc($searchQuery) ?>" class="form-control form-control-sm" placeholder="Cari produk atau SKU...">
        </div>
        <div class="col-sm-5">
          <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="featured" <?= $sort === 'featured' ? 'selected' : '' ?>>Urutan Pilihan</option>
            <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Harga Terendah</option>
            <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Harga Tertinggi</option>
            <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Nama A–Z</option>
          </select>
        </div>
        <div class="col-sm-2 d-grid">
          <button type="submit" class="btn btn-sm btn-pine">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
    <a href="<?= site_url('products') ?>" class="btn btn-sm <?= $activeCategory === '' ? 'btn-pine' : 'btn-outline-secondary' ?>">
      Semua (<?= esc($totalAll ?? count($products)) ?>)
    </a>
    <?php foreach ($categories as $cat): ?>
      <a href="<?= site_url('category/' . $cat['slug']) ?>" class="btn btn-sm <?= $activeCategory === $cat['slug'] ? 'btn-pine' : 'btn-outline-secondary' ?>">
        <?= esc($cat['name']) ?> (<?= esc($cat['count']) ?>)
      </a>
    <?php endforeach; ?>
  </div>
</div>

<?php if (empty($products)): ?>
  <div class="surface-card p-5 text-center">
    <h2 class="h5 fw-bold mb-2">Produk tidak ditemukan</h2>
    <p class="text-secondary small mb-3">Tidak ada produk yang cocok dengan pencarian Anda.</p>
    <a href="<?= site_url('products') ?>" class="btn btn-cta btn-sm">Tampilkan Semua Produk</a>
  </div>
<?php else: ?>
  <div class="small text-secondary mb-3 tabular-nums">Menampilkan <strong><?= count($products) ?></strong> produk</div>
  <div class="row g-4">
    <?php foreach ($products as $product): ?>
      <div class="col-sm-6 col-lg-3">
        <?= view('partials/product_card', ['product' => $product]) ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
