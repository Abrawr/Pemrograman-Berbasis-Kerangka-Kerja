<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4 mb-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
      <h1 class="h4 fw-bold mb-1">Kartu Rencana Studi (KRS) &amp; Nilai</h1>
      <p class="text-secondary small mb-0">Filter berdasarkan mahasiswa untuk melihat daftar MK dan nilai mutu.</p>
    </div>
    <div class="d-flex gap-2">
      <form action="<?= site_url('krs') ?>" method="get" class="d-flex gap-2">
        <select name="mahasiswa_id" class="form-select form-select-sm" onchange="this.form.submit()">
          <option value="">Semua Mahasiswa</option>
          <?php foreach ($mahasiswaList as $m): ?>
            <option value="<?= $m['id'] ?>" <?= (int) ($selectedMhsId ?? 0) === (int) $m['id'] ? 'selected' : '' ?>>
              <?= esc($m['nrp']) ?> — <?= esc($m['nama']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
      <a href="<?= site_url('krs/create') ?>" class="btn btn-sm btn-teal text-nowrap">+ Tambah KRS</a>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="text-center py-5 text-secondary">Belum ada pengambilan KRS untuk filter ini.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>NRP / Mahasiswa</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th class="text-center">SKS</th>
            <th>Tahun Ajaran</th>
            <th class="text-center">Huruf</th>
            <th class="text-end">Bobot</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $row): ?>
            <tr>
              <td>
                <div class="fw-medium"><?= esc($row['nama_mahasiswa']) ?></div>
                <div class="small text-secondary tabular-nums"><?= esc($row['nrp']) ?></div>
              </td>
              <td class="tabular-nums fw-semibold"><?= esc($row['kode_mk']) ?></td>
              <td><?= esc($row['nama_mk']) ?></td>
              <td class="text-center tabular-nums"><?= esc($row['sks']) ?></td>
              <td class="small"><?= esc($row['tahun_ajaran']) ?></td>
              <td class="text-center"><span class="badge text-bg-light border text-dark"><?= esc($row['nilai_huruf'] ?? '-') ?></span></td>
              <td class="text-end tabular-nums"><?= $row['nilai_angka'] !== null ? number_format((float) $row['nilai_angka'], 2) : '-' ?></td>
              <td class="text-end text-nowrap">
                <a href="<?= site_url('krs/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Nilai</a>
                <form action="<?= site_url('krs/delete/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus entri KRS ini?')">
                  <?= csrf_field() ?>
                  <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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
