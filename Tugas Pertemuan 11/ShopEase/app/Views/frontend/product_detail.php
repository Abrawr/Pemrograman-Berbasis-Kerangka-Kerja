<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<?php
$badge = stock_badge((int) $product['stock']);
$disc  = discount_percent((int) $product['price'], $product['original_price'] ?? null);
?>

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb small">
    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('category/' . $product['category_slug']) ?>"><?= esc($product['category_name']) ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= esc($product['name']) ?></li>
  </ol>
</nav>

<div class="surface-card p-4 mb-5">
  <div class="row g-4 align-items-center">
    <div class="col-md-5">
      <div class="rounded p-4 text-center border" style="background-color: #ECEFE9;">
        <img src="<?= base_url($product['image']) ?>" alt="<?= esc($product['name']) ?>" class="img-fluid" style="max-height: 270px;">
      </div>
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

      <p class="text-secondary mb-4"><?= esc($product['description']) ?></p>

      <h2 class="h6 fw-bold mb-2">Spesifikasi Ringkas</h2>
      <div class="table-responsive mb-4">
        <table class="table table-sm mb-0">
          <tbody>
            <?php foreach ($product['specs'] as $label => $val): ?>
              <tr>
                <th class="text-secondary fw-medium" style="width: 170px;"><?= esc($label) ?></th>
                <td><?= esc($val) ?></td>
              </tr>
            <?php endforeach; ?>
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
