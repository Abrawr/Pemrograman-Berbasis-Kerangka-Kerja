<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 680px;">
  <h1 class="h4 fw-bold mb-3"><?= esc($title) ?></h1>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="kode" class="form-label fw-medium">Kode MK</label>
        <input type="text" id="kode" name="kode" class="form-control tabular-nums" value="<?= old('kode', $item['kode'] ?? '') ?>" required>
      </div>
      <div class="col-md-8">
        <label for="nama" class="form-label fw-medium">Nama Mata Kuliah</label>
        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', $item['nama'] ?? '') ?>" required>
      </div>
      <div class="col-md-3">
        <label for="sks" class="form-label fw-medium">SKS</label>
        <input type="number" id="sks" name="sks" min="1" max="6" class="form-control tabular-nums" value="<?= old('sks', $item['sks'] ?? 3) ?>" required>
      </div>
      <div class="col-md-3">
        <label for="semester" class="form-label fw-medium">Semester</label>
        <input type="number" id="semester" name="semester" min="1" max="8" class="form-control tabular-nums" value="<?= old('semester', $item['semester'] ?? 5) ?>" required>
      </div>
      <div class="col-md-6">
        <label for="dosen_id" class="form-label fw-medium">Dosen Pengampu</label>
        <?php $di = (string) old('dosen_id', $item['dosen_id'] ?? ''); ?>
        <select id="dosen_id" name="dosen_id" class="form-select">
          <option value="">— Belum ditentukan —</option>
          <?php foreach ($dosenList as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $di === (string) $d['id'] ? 'selected' : '' ?>><?= esc($d['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-teal">Simpan</button>
      <a href="<?= site_url('matakuliah') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
