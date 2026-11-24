<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'NusaMart') ?> — PBKK C</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/nusamart.css') ?>">
</head>
<body class="d-flex flex-column min-vh-100">
  <?php $activeMenu = $activeMenu ?? 'store'; $cartCount = $cartCount ?? 0; ?>
  <nav class="navbar navbar-expand-lg nm-header navbar-dark py-2">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
          <path d="M6 7h12l1 13H5L6 7z"/><path d="M9 7V6a3 3 0 0 1 6 0v1"/>
        </svg>
        <span>NusaMart</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nmNav" aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nmNav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'store' ? 'active' : '' ?>" href="<?= site_url('/') ?>">Katalog</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'orders' ? 'active' : '' ?>" href="<?= site_url('orders') ?>">Riwayat Pesanan</a></li>
          <li class="nav-item"><a class="nav-link <?= $activeMenu === 'admin' ? 'active' : '' ?>" href="<?= site_url('admin/products') ?>">Admin Produk</a></li>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-sm btn-emerald d-inline-flex align-items-center gap-1" href="<?= site_url('cart') ?>">
              <span>Keranjang</span>
              <span class="badge text-bg-light text-dark tabular-nums"><?= esc($cartCount) ?></span>
            </a>
          </li>
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
      <span>NusaMart Toko Online CodeIgniter 4 — Latihan 2.2 (Materi 18)</span>
      <span>Abrar Maulana (5025241125) · PBKK C</span>
    </div>
  </footer>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
