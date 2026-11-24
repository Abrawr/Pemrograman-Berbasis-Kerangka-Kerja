<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4 mb-4">
  <h2 class="h5 fw-bold mb-1">Panel Operasional Toko</h2>
  <p class="text-secondary small mb-0">
    Halaman ini dapat diakses oleh peran <code>admin</code> dan <code>operator</code> (rute terfilter <code>auth:admin,operator</code>).
  </p>
</div>

<div class="row g-4">
  <div class="col-lg-6">
    <div class="surface-card p-4 h-100">
      <h3 class="h6 fw-bold mb-3">Pemantauan Stok Menipis &amp; Habis (&le; 5 Unit)</h3>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>SKU</th>
              <th>Produk</th>
              <th class="text-end">Stok</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($watchList as $item): ?>
              <?php $badge = stock_badge((int) $item['stock']); ?>
              <tr>
                <td class="se-mono"><?= esc($item['sku']) ?></td>
                <td class="fw-medium"><?= esc($item['name']) ?></td>
                <td class="text-end tabular-nums fw-bold"><?= esc($item['stock']) ?></td>
                <td><span class="badge-stock <?= esc($badge['class']) ?>"><?= esc($badge['label']) ?></span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="surface-card p-4 h-100">
      <h3 class="h6 fw-bold mb-3">Ringkasan Kategori Katalog</h3>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Kategori</th>
              <th>Slug</th>
              <th class="text-end">Jumlah Produk</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $cat): ?>
              <tr>
                <td class="fw-medium"><?= esc($cat['name']) ?></td>
                <td class="se-mono text-secondary"><?= esc($cat['slug']) ?></td>
                <td class="text-end tabular-nums"><?= esc($cat['count']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
