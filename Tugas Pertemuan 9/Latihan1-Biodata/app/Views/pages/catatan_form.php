<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 720px;">
  <h2 class="h4 fw-bold mb-3"><?= esc($title) ?></h2>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="modul_pbkk" class="form-label fw-medium">Kode Modul</label>
        <input type="text" id="modul_pbkk" name="modul_pbkk" class="form-control" value="<?= old('modul_pbkk', $item['modul_pbkk'] ?? 'PBKK 2-5') ?>" required>
      </div>
      <div class="col-md-4">
        <label for="kategori" class="form-label fw-medium">Kategori</label>
        <input type="text" id="kategori" name="kategori" class="form-control" value="<?= old('kategori', $item['kategori'] ?? 'Backend') ?>" required>
      </div>
      <div class="col-md-4">
        <label for="status" class="form-label fw-medium">Status</label>
        <?php $currentStatus = old('status', $item['status'] ?? 'Selesai'); ?>
        <select id="status" name="status" class="form-select">
          <?php foreach (['Selesai', 'Proses', 'Direncanakan'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $currentStatus === $opt ? 'selected' : '' ?>><?= $opt ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12">
        <label for="judul" class="form-label fw-medium">Judul Catatan</label>
        <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul', $item['judul'] ?? '') ?>" required>
      </div>
      <div class="col-12">
        <label for="isi" class="form-label fw-medium">Deskripsi Implementasi</label>
        <textarea id="isi" name="isi" rows="4" class="form-control" required><?= old('isi', $item['isi'] ?? '') ?></textarea>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-primary">Simpan Catatan</button>
      <a href="<?= site_url('catatan') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
