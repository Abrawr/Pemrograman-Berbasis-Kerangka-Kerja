<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
      <h2 class="h5 fw-bold mb-1">Kategori Produk</h2>
      <p class="small text-secondary mb-0">Menghapus kategori yang masih memiliki produk ditolak otomatis (aturan foreign key <code>RESTRICT</code>).</p>
    </div>
    <a href="<?= site_url('admin/categories/create') ?>" class="btn btn-sm btn-cta">+ Tambah Kategori</a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Kategori</th>
          <th>Slug</th>
          <th>Deskripsi</th>
          <th class="text-end">Produk</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $cat): ?>
          <tr>
            <td class="tabular-nums text-secondary"><?= esc($cat['id']) ?></td>
            <td class="fw-semibold"><?= esc($cat['name']) ?></td>
            <td class="se-mono text-secondary"><?= esc($cat['slug']) ?></td>
            <td class="small text-secondary"><?= esc($cat['description'] ?? '-') ?></td>
            <td class="text-end tabular-nums fw-semibold"><?= esc($cat['count']) ?></td>
            <td class="text-end text-nowrap">
              <a href="<?= site_url('admin/categories/edit/' . $cat['id']) ?>" class="btn btn-sm btn-outline-dark">Edit</a>
              <?php if (session()->get('user_role') === 'admin'): ?>
                <form action="<?= site_url('admin/categories/delete/' . $cat['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                  <?= csrf_field() ?>
                  <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
