<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-3 mb-4">
  <div class="row text-center g-3">
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Total Produk</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($stats['total_products']) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Kategori</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($stats['total_categories']) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Tersedia / Nonaktif</div>
      <div class="fs-3 fw-bold tabular-nums">
        <span class="text-success"><?= esc($stats['available']) ?></span> /
        <span class="text-danger"><?= esc($stats['unavailable']) ?></span>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="small text-secondary">Stok Menipis / Habis</div>
      <div class="fs-3 fw-bold tabular-nums">
        <span class="text-warning"><?= esc($stats['low_stock']) ?></span> /
        <span class="text-danger"><?= esc($stats['out_of_stock']) ?></span>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="surface-card p-4 h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Distribusi Produk per Kategori</h2>
        <a href="<?= site_url('admin/categories') ?>" class="btn btn-sm btn-outline-dark">Kelola</a>
      </div>
      <?php $maxCount = max(1, (int) max(array_column($categories, 'count') ?: [1])); ?>
      <div class="d-flex flex-column gap-3">
        <?php foreach ($categories as $cat): ?>
          <?php $pct = (int) round(((int) $cat['count'] / $maxCount) * 100); ?>
          <div>
            <div class="d-flex justify-content-between small mb-1">
              <span class="fw-medium"><?= esc($cat['name']) ?></span>
              <span class="tabular-nums text-secondary"><?= esc($cat['count']) ?> produk</span>
            </div>
            <div class="progress" style="height: 8px;">
              <div class="progress-bar" style="width: <?= $pct ?>%; background-color: var(--se-pine);"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
        <a href="<?= site_url('admin/products/create') ?>" class="btn btn-sm btn-cta">+ Tambah Produk</a>
        <a href="<?= site_url('admin/products') ?>" class="btn btn-sm btn-pine">Daftar Produk</a>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="surface-card p-4 h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Peringatan Stok (&le; 5 Unit)</h2>
        <a href="<?= site_url('admin/inventory?mode=low') ?>" class="btn btn-sm btn-outline-dark">Buka Inventaris</a>
      </div>
      <?php if (empty($alerts)): ?>
        <div class="text-secondary py-4 text-center">Semua produk memiliki stok aman.</div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th class="text-end">Stok</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($alerts as $item): ?>
                <?php $badge = stock_badge((int) $item['stock']); ?>
                <tr>
                  <td class="se-mono"><?= esc($item['sku']) ?></td>
                  <td class="fw-medium"><?= esc($item['name']) ?></td>
                  <td class="small text-secondary"><?= esc($item['category_name']) ?></td>
                  <td class="text-end tabular-nums fw-bold"><?= esc($item['stock']) ?></td>
                  <td><span class="badge-stock <?= esc($badge['class']) ?>"><?= esc($badge['label']) ?></span></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
