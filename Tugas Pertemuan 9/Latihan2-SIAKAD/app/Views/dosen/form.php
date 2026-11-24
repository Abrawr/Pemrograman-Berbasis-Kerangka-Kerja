<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 680px;">
  <h1 class="h4 fw-bold mb-3"><?= esc($title) ?></h1>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="nidn" class="form-label fw-medium">NIDN</label>
        <input type="text" id="nidn" name="nidn" class="form-control tabular-nums" value="<?= old('nidn', $item['nidn'] ?? '') ?>" required>
      </div>
      <div class="col-md-8">
        <label for="nama" class="form-label fw-medium">Nama &amp; Gelar</label>
        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', $item['nama'] ?? '') ?>" required>
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label fw-medium">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= old('email', $item['email'] ?? '') ?>" required>
      </div>
      <div class="col-md-6">
        <label for="keahlian" class="form-label fw-medium">Bidang Keahlian</label>
        <input type="text" id="keahlian" name="keahlian" class="form-control" value="<?= old('keahlian', $item['keahlian'] ?? '') ?>" required>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-teal">Simpan</button>
      <a href="<?= site_url('dosen') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
