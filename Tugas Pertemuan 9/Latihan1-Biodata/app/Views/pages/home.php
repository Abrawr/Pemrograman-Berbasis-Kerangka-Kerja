<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
  <div class="col-lg-8">
    <div class="surface-card p-4 h-100">
      <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">
        <div>
          <h2 class="h4 fw-bold mb-1">Selamat Datang — Profil Biodata Mahasiswa</h2>
          <p class="text-secondary mb-0">Implementasi Latihan 1 Materi Framework CodeIgniter (PBKK 2-1 sampai 2-7).</p>
        </div>
        <span class="badge text-bg-primary">CodeIgniter 4</span>
      </div>
      <div class="table-responsive">
        <table class="table table-sm mb-0 align-middle">
          <tbody>
            <tr><th class="text-secondary fw-medium" style="width: 180px;">Nama Lengkap</th><td class="fw-semibold">Abrar Maulana</td></tr>
            <tr><th class="text-secondary fw-medium">NRP</th><td class="tabular-nums fw-semibold">5025241125</td></tr>
            <tr><th class="text-secondary fw-medium">Kelas / Mata Kuliah</th><td>Pemrograman Berbasis Kerangka Kerja (PBKK C)</td></tr>
            <tr><th class="text-secondary fw-medium">Program Studi</th><td>S1 Teknik Informatika — Institut Teknologi Sepuluh Nopember</td></tr>
            <tr><th class="text-secondary fw-medium">Fokus Latihan 1</th><td>Welcome Biodata, Routing &amp; Controller, SB Admin Partial, CRUD Model, Upload, Auth</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="surface-card p-4 h-100 d-flex flex-column justify-content-between">
      <div>
        <h2 class="h6 fw-bold mb-3">Ringkasan Data Tersimpan</h2>
        <div class="d-flex justify-content-between py-2 border-bottom">
          <span class="text-secondary">Catatan Praktikum</span>
          <strong class="tabular-nums fs-5"><?= esc($totalCatatan) ?></strong>
        </div>
        <div class="d-flex justify-content-between py-2">
          <span class="text-secondary">Berkas Diunggah</span>
          <strong class="tabular-nums fs-5"><?= esc($totalBerkas) ?></strong>
        </div>
      </div>
      <div class="d-grid gap-2 mt-3">
        <a href="<?= site_url('catatan') ?>" class="btn btn-primary btn-sm">Buka Modul Catatan CRUD</a>
        <a href="<?= site_url('upload') ?>" class="btn btn-outline-secondary btn-sm">Buka Modul Upload Berkas</a>
      </div>
    </div>
  </div>
</div>

<div class="surface-card p-4 mb-4">
  <h2 class="h5 fw-bold mb-3">Peta Implementasi Modul PBKK 2-1 s.d. 2-7</h2>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Topik Modul</th>
          <th>Fitur Terimplementasi</th>
          <th>Rute</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($modules as $mod): ?>
          <tr>
            <td class="fw-semibold text-primary text-nowrap"><?= esc($mod['kode']) ?></td>
            <td class="fw-medium"><?= esc($mod['judul']) ?></td>
            <td class="text-secondary"><?= esc($mod['fitur']) ?></td>
            <td><a href="<?= site_url(ltrim($mod['rute'], '/')) ?>" class="btn btn-sm btn-outline-primary"><?= esc($mod['rute']) ?></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
