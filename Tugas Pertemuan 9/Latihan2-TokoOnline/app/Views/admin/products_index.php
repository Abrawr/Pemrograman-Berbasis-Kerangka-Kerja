<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 fw-bold mb-1">Admin — Manajemen Produk</h1>
      <p class="text-secondary small mb-0">Kelola katalog produk, stok, dan harga jual.</p>
    </div>
    <a href="<?= site_url('admin/products/create') ?>" class="btn btn-sm btn-emerald">+ Tambah Produk</a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>SKU</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th class="text-end">Harga</th>
          <th class="text-end">Stok</th>
          <th class="text-center">Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
          <tr>
            <td class="tabular-nums fw-semibold"><?= esc($p['sku']) ?></td>
            <td class="fw-medium"><?= esc($p['name']) ?></td>
            <td><?= esc($p['category_name']) ?></td>
            <td class="text-end tabular-nums">Rp <?= number_format((int) $p['price'], 0, ',', '.') ?></td>
            <td class="text-end tabular-nums"><?= esc($p['stock']) ?></td>
            <td class="text-center">
              <span class="badge <?= (int) $p['is_active'] === 1 ? 'text-bg-success' : 'text-bg-secondary' ?>">
                <?= (int) $p['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?>
              </span>
            </td>
            <td class="text-end text-nowrap">
              <a href="<?= site_url('admin/products/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="<?= site_url('admin/products/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
