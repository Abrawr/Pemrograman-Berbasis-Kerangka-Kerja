<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'SIAKAD') ?> — PBKK C</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/siakad.css') ?>">
</head>
<body class="d-flex flex-column min-vh-100">
  <?php $activeMenu = $activeMenu ?? 'dashboard'; ?>
  <nav class="navbar navbar-expand-lg siakad-nav navbar-dark py-2">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
          <path d="M12 3 2 8l10 5 10-5-10-5z"/><path d="M6 10.5V16c0 1.7 2.7 3 6 3s6-1.3 6-3v-5.5"/>
        </svg>
        <span>SIAKAD Akademik</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siakadNav" aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="siakadNav">
        <ul class="navbar-nav ms-auto gap-1">
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('/') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'mahasiswa' ? 'active' : '' ?>" href="<?= site_url('mahasiswa') ?>">Mahasiswa</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'dosen' ? 'active' : '' ?>" href="<?= site_url('dosen') ?>">Dosen</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'matakuliah' ? 'active' : '' ?>" href="<?= site_url('matakuliah') ?>">Mata Kuliah</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'krs' ? 'active' : '' ?>" href="<?= site_url('krs') ?>">KRS &amp; Nilai</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4 flex-grow-1">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    <?php endif; ?>
    <?php if ($errors = session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger" role="alert">
        <ul class="mb-0 ps-3">
          <?php foreach ((array) $errors as $err): ?>
            <li><?= esc($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </main>

  <footer class="bg-white border-top py-3 text-secondary small">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
      <span>SIAKAD CodeIgniter 4 — Latihan 2.1 (Materi 18)</span>
      <span>Abrar Maulana (5025241125) · PBKK C</span>
    </div>
  </footer>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
