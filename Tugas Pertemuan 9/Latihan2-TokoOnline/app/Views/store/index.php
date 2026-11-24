<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4 mb-4">
  <div class="row align-items-center g-3">
    <div class="col-lg-7">
      <h1 class="h3 fw-bold mb-1">NusaMart — Perlengkapan Kuliah &amp; Produktivitas</h1>
      <p class="text-secondary mb-0">Aplikasi Toko Online dengan keranjang sesi, checkout transaksi database, dan manajemen produk admin.</p>
    </div>
    <div class="col-lg-5">
      <form action="<?= site_url('/') ?>" method="get" class="d-flex gap-2">
        <?php if (! empty($activeCategory)): ?>
          <input type="hidden" name="kategori" value="<?= esc($activeCategory) ?>">
        <?php endif; ?>
        <input type="search" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control" placeholder="Cari produk atau SKU...">
        <button type="submit" class="btn btn-emerald">Cari</button>
      </form>
    </div>
  </div>
  <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
    <a href="<?= site_url('/') ?>" class="btn btn-sm <?= empty($activeCategory) ? 'btn-dark' : 'btn-outline-secondary' ?>">Semua Kategori</a>
    <?php foreach ($categories as $cat): ?>
      <a href="<?= site_url('/?kategori=' . urlencode($cat['slug'])) ?>" class="btn btn-sm <?= ($activeCategory ?? '') === $cat['slug'] ? 'btn-dark' : 'btn-outline-secondary' ?>">
        <?= esc($cat['name']) ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<?php if (empty($products)): ?>
  <div class="surface-card p-5 text-center text-secondary">
    Tidak ada produk yang cocok dengan pencarian Anda.
    <div class="mt-2"><a href="<?= site_url('/') ?>" class="btn btn-sm btn-outline-secondary">Reset Filter</a></div>
  </div>
<?php else: ?>
  <div class="row g-4">
    <?php foreach ($products as $p): ?>
      <div class="col-sm-6 col-lg-3">
        <div class="surface-card h-100 d-flex flex-column">
          <a href="<?= site_url('produk/' . $p['slug']) ?>" class="product-thumb text-decoration-none">
            <img src="<?= base_url($p['image'] ?: 'assets/images/produk-headset.svg') ?>" alt="<?= esc($p['name']) ?>">
          </a>
          <div class="p-3 d-flex flex-column flex-grow-1">
            <div class="small text-secondary mb-1"><?= esc($p['category_name']) ?></div>
            <h2 class="h6 fw-bold mb-1">
              <a href="<?= site_url('produk/' . $p['slug']) ?>" class="text-decoration-none text-dark"><?= esc($p['name']) ?></a>
            </h2>
            <div class="fw-bold text-success tabular-nums mb-2">Rp <?= number_format((int) $p['price'], 0, ',', '.') ?></div>
            <div class="small text-secondary tabular-nums mb-3">Stok tersedia: <?= esc($p['stock']) ?></div>
            <form action="<?= site_url('cart/add') ?>" method="post" class="mt-auto d-grid">
              <?= csrf_field() ?>
              <input type="hidden" name="product_id" value="<?= esc($p['id']) ?>">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="btn btn-sm btn-emerald" <?= (int) $p['stock'] < 1 ? 'disabled' : '' ?>>
                <?= (int) $p['stock'] > 0 ? '+ Tambah ke Keranjang' : 'Stok Habis' ?>
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
