<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
      <h2 class="h5 fw-bold mb-1">Manajemen Inventaris &amp; Pembaruan Stok Cepat</h2>
      <p class="small text-secondary mb-0">Memperbarui stok ke <code>0</code> otomatis mengubah status ke <code>tidak_tersedia</code>.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
      <a href="<?= site_url('admin/inventory?mode=all') ?>" class="btn btn-sm <?= $mode === 'all' ? 'btn-pine' : 'btn-outline-secondary' ?>">
        Semua (<?= esc($stats['total_products']) ?>)
      </a>
      <a href="<?= site_url('admin/inventory?mode=low') ?>" class="btn btn-sm <?= $mode === 'low' ? 'btn-warning' : 'btn-outline-warning text-dark' ?>">
        Stok Menipis &le; 5 (<?= esc($stats['low_stock']) ?>)
      </a>
      <a href="<?= site_url('admin/inventory?mode=out') ?>" class="btn btn-sm <?= $mode === 'out' ? 'btn-danger' : 'btn-outline-danger' ?>">
        Stok Habis (<?= esc($stats['out_of_stock']) ?>)
      </a>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="text-center py-5 text-secondary">Tidak ada produk dalam filter inventaris ini.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Status Saat Ini</th>
            <th style="width: 220px;">Perbarui Stok</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <?php $badge = stock_badge((int) $item['stock']); ?>
            <tr>
              <td class="se-mono"><?= esc($item['sku']) ?></td>
              <td class="fw-medium"><?= esc($item['name']) ?></td>
              <td class="small text-secondary"><?= esc($item['category_name']) ?></td>
              <td>
                <span class="badge-stock <?= esc($badge['class']) ?>"><?= esc($badge['label']) ?></span>
                <span class="small text-secondary ms-1">(<?= esc($item['status']) ?>)</span>
              </td>
              <td>
                <form action="<?= site_url('admin/inventory/update/' . $item['id']) ?>" method="post" class="d-flex gap-2">
                  <?= csrf_field() ?>
                  <input type="number" name="stock" value="<?= esc($item['stock']) ?>" min="0" class="form-control form-control-sm tabular-nums" aria-label="Stok <?= esc($item['name']) ?>">
                  <button type="submit" class="btn btn-sm btn-pine text-nowrap">Simpan</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
