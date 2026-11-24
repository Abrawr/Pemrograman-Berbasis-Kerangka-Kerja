<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<?php
$badge = stock_badge((int) $product['stock']);
$disc  = discount_percent((int) $product['price'], isset($product['original_price']) ? (int) $product['original_price'] : null);
$images = $product['images'] ?? [];
$mainImage = $product['image'] ?? 'assets/images/products/headphone-bluetooth-studio.svg';
?>

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb small">
    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('category/' . $product['category_slug']) ?>"><?= esc($product['category_name']) ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= esc($product['name']) ?></li>
  </ol>
</nav>

<div class="surface-card p-4 mb-5">
  <div class="row g-4 align-items-start">
    <div class="col-md-5">
      <div class="rounded p-4 text-center border mb-3" style="background-color: #ECEFE9;">
        <img id="mainProductImg" src="<?= base_url($mainImage) ?>" alt="<?= esc($product['name']) ?>" class="img-fluid" style="max-height: 270px;">
      </div>
      <?php if (count($images) > 1): ?>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($images as $idx => $img): ?>
            <button type="button"
              class="btn p-1 border rounded bg-white"
              style="width: 68px; height: 56px;"
              onclick="document.getElementById('mainProductImg').src='<?= base_url($img['image_path']) ?>'">
              <img src="<?= base_url($img['image_path']) ?>" alt="Galeri <?= $idx + 1 ?>" class="w-100 h-100 object-fit-contain">
            </button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="col-md-7">
      <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
        <span class="se-mono text-secondary"><?= esc($product['sku']) ?></span>
        <span class="badge-stock <?= esc($badge['class']) ?>"><?= esc($badge['label']) ?></span>
        <?php if ($disc > 0): ?>
          <span class="badge text-bg-danger tabular-nums">Hemat <?= esc($disc) ?>%</span>
        <?php endif; ?>
      </div>

      <h1 class="h2 fw-bold mb-2"><?= esc($product['name']) ?></h1>

      <div class="d-flex align-items-baseline gap-3 mb-3">
        <span class="fs-2 fw-bold tabular-nums" style="color: var(--se-pine);">
          <?= esc(format_rupiah($product['price'])) ?>
        </span>
        <?php if ($disc > 0): ?>
          <span class="text-secondary text-decoration-line-through tabular-nums">
            <?= esc(format_rupiah($product['original_price'])) ?>
          </span>
        <?php endif; ?>
      </div>

      <p class="fw-medium mb-2"><?= esc($product['short_desc'] ?? '') ?></p>
      <p class="text-secondary mb-4"><?= esc($product['description'] ?? '') ?></p>

      <div class="table-responsive mb-4">
        <table class="table table-sm mb-0">
          <tbody>
            <tr><th class="text-secondary fw-medium" style="width: 170px;">Kategori</th><td><?= esc($product['category_name']) ?></td></tr>
            <tr><th class="text-secondary fw-medium">SKU</th><td class="se-mono"><?= esc($product['sku']) ?></td></tr>
            <tr><th class="text-secondary fw-medium">Stok Tersedia</th><td class="tabular-nums"><?= esc($product['stock']) ?> unit</td></tr>
            <tr><th class="text-secondary fw-medium">Status Katalog</th><td><?= esc($product['status']) ?></td></tr>
          </tbody>
        </table>
      </div>

      <div class="d-flex flex-wrap gap-2">
        <a href="<?= site_url('category/' . $product['category_slug']) ?>" class="btn btn-cta">
          Lihat Kategori <?= esc($product['category_name']) ?>
        </a>
        <a href="<?= site_url('products') ?>" class="btn btn-outline-dark">Kembali ke Katalog</a>
      </div>
    </div>
  </div>
</div>

<?php if (! empty($related)): ?>
  <section>
    <h2 class="h5 fw-bold mb-3">Produk Serupa di Kategori <?= esc($product['category_name']) ?></h2>
    <div class="row g-4">
      <?php foreach ($related as $rel): ?>
        <div class="col-md-4">
          <?= view('partials/product_card', ['product' => $rel]) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>

<?= $this->endSection() ?>
