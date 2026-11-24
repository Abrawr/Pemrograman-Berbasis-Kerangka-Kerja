<?php
$badge = stock_badge((int) $product['stock']);
$disc  = discount_percent((int) $product['price'], $product['original_price'] ?? null);
?>
<div class="surface-card product-card h-100 d-flex flex-column">
  <a href="<?= site_url('products/' . $product['slug']) ?>" class="product-media text-decoration-none">
    <img src="<?= base_url($product['image']) ?>" alt="<?= esc($product['name']) ?>">
  </a>
  <div class="p-3 d-flex flex-column flex-grow-1">
    <div class="d-flex justify-content-between align-items-center gap-2 mb-1">
      <a href="<?= site_url('category/' . $product['category_slug']) ?>" class="small text-secondary text-decoration-none">
        <?= esc($product['category_name']) ?>
      </a>
      <span class="badge-stock <?= esc($badge['class']) ?>"><?= esc($badge['label']) ?></span>
    </div>

    <h3 class="h6 fw-bold mb-1">
      <a href="<?= site_url('products/' . $product['slug']) ?>" class="text-decoration-none text-dark">
        <?= esc($product['name']) ?>
      </a>
    </h3>

    <p class="small text-secondary mb-3 flex-grow-1">
      <?= esc($product['short_desc']) ?>
    </p>

    <div class="pt-2 border-top d-flex justify-content-between align-items-end gap-2">
      <div>
        <div class="fw-bold fs-6 tabular-nums" style="color: var(--se-pine);">
          <?= esc(format_rupiah($product['price'])) ?>
        </div>
        <?php if ($disc > 0): ?>
          <div class="small text-secondary text-decoration-line-through tabular-nums">
            <?= esc(format_rupiah($product['original_price'])) ?>
          </div>
        <?php endif; ?>
      </div>
      <a href="<?= site_url('products/' . $product['slug']) ?>" class="btn btn-sm btn-outline-dark">Detail</a>
    </div>
  </div>
</div>
