<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 640px;">
  <h2 class="h5 fw-bold mb-3"><?= esc($title) ?></h2>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label for="name" class="form-label fw-medium">Nama Kategori</label>
      <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $category['name'] ?? '') ?>" required>
    </div>
    <div class="mb-4">
      <label for="description" class="form-label fw-medium">Deskripsi Singkat</label>
      <textarea id="description" name="description" rows="3" class="form-control"><?= old('description', $category['description'] ?? '') ?></textarea>
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-cta">Simpan Kategori</button>
      <a href="<?= site_url('admin/categories') ?>" class="btn btn-outline-dark">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
