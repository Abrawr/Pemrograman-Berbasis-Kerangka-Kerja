<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 — Halaman Tidak Ditemukan | ShopEase</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/shopease.css') ?>">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-4">
  <div class="surface-card p-5 text-center" style="max-width: 520px;">
    <div class="fw-bold display-5 tabular-nums mb-2" style="color: var(--se-pine);">404</div>
    <h1 class="h4 fw-bold mb-2">Halaman atau Produk Tidak Ditemukan</h1>
    <p class="text-secondary small mb-4">
      <?= esc($message ?? 'Tautan yang Anda tuju tidak tersedia atau sudah berpindah.') ?>
    </p>
    <div class="d-flex justify-content-center gap-2">
      <a href="<?= site_url('/') ?>" class="btn btn-cta">Kembali ke Beranda</a>
      <a href="<?= site_url('products') ?>" class="btn btn-outline-dark">Lihat Katalog</a>
    </div>
  </div>
</body>
</html>
