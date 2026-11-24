<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
      <h2 class="h5 fw-bold mb-1">Manajemen Produk (CRUD, Pencarian &amp; Paginasi)</h2>
      <p class="small text-secondary mb-0">Menampilkan maksimal 8 produk per halaman; hapus produk khusus role <code>admin</code>.</p>
    </div>
    <a href="<?= site_url('admin/products/create') ?>" class="btn btn-sm btn-cta">+ Tambah Produk</a>
  </div>

  <form action="<?= site_url('admin/products') ?>" method="get" class="row g-2 mb-4">
    <div class="col-md-4">
      <input type="search" name="q" value="<?= esc($filters['q'] ?? '') ?>" class="form-control form-control-sm" placeholder="Cari nama produk atau SKU...">
    </div>
    <div class="col-md-3">
      <select name="category_id" class="form-select form-select-sm">
        <option value="">Semua Kategori</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat['id'] ?>" <?= (string) ($filters['category_id'] ?? '') === (string) $cat['id'] ? 'selected' : '' ?>>
            <?= esc($cat['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select form-select-sm">
        <option value="">Semua Status</option>
        <option value="tersedia" <?= ($filters['status'] ?? '') === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
        <option value="tidak_tersedia" <?= ($filters['status'] ?? '') === 'tidak_tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
      </select>
    </div>
    <div class="col-md-2 d-flex gap-1">
      <button type="submit" class="btn btn-sm btn-pine flex-grow-1">Filter</button>
      <a href="<?= site_url('admin/products') ?>" class="btn btn-sm btn-outline-secondary">Reset</a>
    </div>
  </form>

  <?php if (empty($products)): ?>
    <div class="text-center py-5 text-secondary">Tidak ada produk yang cocok dengan filter ini.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>SKU &amp; Nama Produk</th>
            <th>Kategori</th>
            <th class="text-end">Harga</th>
            <th class="text-end">Stok</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $p): ?>
            <?php $img = ! empty($p['image']) ? $p['image'] : 'assets/images/products/headphone-bluetooth-studio.svg'; ?>
            <tr>
              <td style="width: 68px;">
                <img src="<?= base_url($img) ?>" alt="<?= esc($p['name']) ?>" class="rounded border bg-light" style="width: 56px; height: 42px; object-fit: contain;">
              </td>
              <td>
                <div class="fw-semibold"><?= esc($p['name']) ?></div>
                <div class="se-mono text-secondary"><?= esc($p['sku']) ?></div>
              </td>
              <td><?= esc($p['category_name']) ?></td>
              <td class="text-end tabular-nums fw-medium"><?= esc(format_rupiah($p['price'])) ?></td>
              <td class="text-end tabular-nums fw-bold"><?= esc($p['stock']) ?></td>
              <td>
                <span class="badge <?= $p['status'] === 'tersedia' ? 'text-bg-success' : 'text-bg-secondary' ?>">
                  <?= esc($p['status']) ?>
                </span>
              </td>
              <td class="text-end text-nowrap">
                <a href="<?= site_url('admin/products/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-dark">Edit / Galeri</a>
                <?php if (session()->get('user_role') === 'admin'): ?>
                  <form action="<?= site_url('admin/products/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus produk ini beserta seluruh gambarnya?')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                  </form>
                <?php else: ?>
                  <span class="badge text-bg-light border text-secondary ms-1">Admin only delete</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
      <div class="small text-secondary">Halaman <?= esc($pager->getCurrentPage()) ?> dari <?= esc($pager->getPageCount()) ?></div>
      <div><?= $pager->links() ?></div>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
