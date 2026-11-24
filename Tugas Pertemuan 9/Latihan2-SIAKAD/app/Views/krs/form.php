<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 680px;">
  <h1 class="h4 fw-bold mb-3"><?= esc($title) ?></h1>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-6">
        <label for="mahasiswa_id" class="form-label fw-medium">Mahasiswa</label>
        <?php $mid = (int) old('mahasiswa_id', $item['mahasiswa_id'] ?? 0); ?>
        <select id="mahasiswa_id" name="mahasiswa_id" class="form-select" required>
          <?php foreach ($mahasiswaList as $m): ?>
            <option value="<?= $m['id'] ?>" <?= $mid === (int) $m['id'] ? 'selected' : '' ?>>
              <?= esc($m['nrp']) ?> — <?= esc($m['nama']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="mata_kuliah_id" class="form-label fw-medium">Mata Kuliah</label>
        <?php $mkid = (int) old('mata_kuliah_id', $item['mata_kuliah_id'] ?? 0); ?>
        <select id="mata_kuliah_id" name="mata_kuliah_id" class="form-select" required>
          <?php foreach ($mkList as $mk): ?>
            <option value="<?= $mk['id'] ?>" <?= $mkid === (int) $mk['id'] ? 'selected' : '' ?>>
              <?= esc($mk['kode']) ?> — <?= esc($mk['nama']) ?> (<?= esc($mk['sks']) ?> SKS)
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label for="tahun_ajaran" class="form-label fw-medium">Tahun Ajaran</label>
        <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" value="<?= old('tahun_ajaran', $item['tahun_ajaran'] ?? '2026/2027-Ganjil') ?>" required>
      </div>
      <div class="col-md-6">
        <label for="nilai_huruf" class="form-label fw-medium">Nilai Huruf</label>
        <?php $nh = (string) old('nilai_huruf', $item['nilai_huruf'] ?? ''); ?>
        <select id="nilai_huruf" name="nilai_huruf" class="form-select">
          <option value="">Belum Dinilai</option>
          <?php foreach ($gradeOptions as $g): ?>
            <option value="<?= $g ?>" <?= $nh === $g ? 'selected' : '' ?>><?= $g ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-teal">Simpan KRS</button>
      <a href="<?= site_url('krs') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
