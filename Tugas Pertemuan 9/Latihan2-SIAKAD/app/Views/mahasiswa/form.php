<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 720px;">
  <h1 class="h4 fw-bold mb-3"><?= esc($title) ?></h1>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="nrp" class="form-label fw-medium">NRP</label>
        <input type="text" id="nrp" name="nrp" class="form-control tabular-nums" value="<?= old('nrp', $item['nrp'] ?? '') ?>" required>
      </div>
      <div class="col-md-8">
        <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', $item['nama'] ?? '') ?>" required>
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label fw-medium">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= old('email', $item['email'] ?? '') ?>" required>
      </div>
      <div class="col-md-3">
        <label for="angkatan" class="form-label fw-medium">Angkatan</label>
        <input type="number" id="angkatan" name="angkatan" class="form-control tabular-nums" value="<?= old('angkatan', $item['angkatan'] ?? 2024) ?>" required>
      </div>
      <div class="col-md-3">
        <label for="status" class="form-label fw-medium">Status</label>
        <?php $st = old('status', $item['status'] ?? 'Aktif'); ?>
        <select id="status" name="status" class="form-select">
          <?php foreach (['Aktif', 'Cuti', 'Lulus'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $st === $opt ? 'selected' : '' ?>><?= $opt ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="prodi" class="form-label fw-medium">Program Studi</label>
        <input type="text" id="prodi" name="prodi" class="form-control" value="<?= old('prodi', $item['prodi'] ?? 'Teknik Informatika') ?>" required>
      </div>
      <div class="col-md-6">
        <label for="dosen_wali_id" class="form-label fw-medium">Dosen Wali</label>
        <?php $dw = (string) old('dosen_wali_id', $item['dosen_wali_id'] ?? ''); ?>
        <select id="dosen_wali_id" name="dosen_wali_id" class="form-select">
          <option value="">— Belum ditentukan —</option>
          <?php foreach ($dosenList as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $dw === (string) $d['id'] ? 'selected' : '' ?>><?= esc($d['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-teal">Simpan</button>
      <a href="<?= site_url('mahasiswa') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
