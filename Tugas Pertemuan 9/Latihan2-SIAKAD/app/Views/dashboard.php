<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h1 class="h3 fw-bold mb-1">Dashboard Sistem Informasi Akademik</h1>
    <p class="text-secondary mb-0">Rekap data mahasiswa, dosen, mata kuliah, pengambilan KRS, serta kalkulasi IPK otomatis.</p>
  </div>
  <a href="<?= site_url('krs/create') ?>" class="btn btn-teal">+ Input KRS / Nilai</a>
</div>

<div class="surface-card p-3 mb-4">
  <div class="row text-center g-3">
    <div class="col-6 col-md-3 border-end">
      <div class="text-secondary small">Mahasiswa</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($totalMahasiswa) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="text-secondary small">Dosen Pengampu</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($totalDosen) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="text-secondary small">Mata Kuliah</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($totalMk) ?></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="text-secondary small">Entri KRS</div>
      <div class="fs-3 fw-bold tabular-nums text-success"><?= esc($totalKrs) ?></div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-6">
    <div class="surface-card p-4 h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Ringkasan SKS &amp; IPK Mahasiswa</h2>
        <a href="<?= site_url('mahasiswa') ?>" class="btn btn-sm btn-outline-secondary">Kelola</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>NRP</th>
              <th>Nama</th>
              <th class="text-end">SKS</th>
              <th class="text-end">IPK</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ipkSummary as $row): ?>
              <tr>
                <td class="tabular-nums fw-semibold"><?= esc($row['nrp']) ?></td>
                <td><?= esc($row['nama']) ?></td>
                <td class="text-end tabular-nums"><?= esc($row['total_sks']) ?></td>
                <td class="text-end tabular-nums fw-bold text-primary"><?= number_format((float) $row['ipk'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="surface-card p-4 h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Catatan KRS Terbaru</h2>
        <a href="<?= site_url('krs') ?>" class="btn btn-sm btn-outline-secondary">Semua KRS</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Mahasiswa</th>
              <th>Mata Kuliah</th>
              <th class="text-center">SKS</th>
              <th class="text-center">Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentKrs as $krs): ?>
              <tr>
                <td>
                  <div class="fw-medium"><?= esc($krs['nama_mahasiswa']) ?></div>
                  <div class="small text-secondary tabular-nums"><?= esc($krs['nrp']) ?></div>
                </td>
                <td>
                  <div class="fw-medium"><?= esc($krs['nama_mk']) ?></div>
                  <div class="small text-secondary tabular-nums"><?= esc($krs['kode_mk']) ?></div>
                </td>
                <td class="text-center tabular-nums"><?= esc($krs['sks']) ?></td>
                <td class="text-center">
                  <span class="badge text-bg-light border text-dark tabular-nums">
                    <?= esc($krs['nilai_huruf'] ?? '-') ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
