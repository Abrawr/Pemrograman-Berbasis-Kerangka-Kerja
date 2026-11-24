<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Panel ShopEase') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/shopease.css') ?>">
</head>
<body>
  <?php
  $role        = (string) session()->get('user_role');
  $activePanel = $activePanel ?? 'dashboard';
  ?>
  <div class="op-shell">
    <aside class="op-sidebar">
      <div class="op-brand">
        <a href="<?= site_url('/') ?>" class="op-brand-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M5 8h14l-1.2 11H6.2L5 8z"/>
            <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
          </svg>
          <span>ShopEase Panel</span>
        </a>
      </div>

      <div class="op-nav-section">Panel Role</div>
      <?php if ($role === 'admin'): ?>
        <a href="<?= site_url('admin/dashboard') ?>" class="op-nav-link <?= $activePanel === 'dashboard' ? 'active' : '' ?>">
          <span>Dashboard Admin</span>
        </a>
      <?php endif; ?>
      <?php if (in_array($role, ['admin', 'operator'], true)): ?>
        <a href="<?= site_url('operator/dashboard') ?>" class="op-nav-link <?= $activePanel === 'operator' ? 'active' : '' ?>">
          <span>Operasional Toko</span>
        </a>
      <?php endif; ?>
      <a href="<?= site_url('account') ?>" class="op-nav-link <?= $activePanel === 'account' ? 'active' : '' ?>">
        <span>Profil Akun Saya</span>
      </a>

      <div class="op-nav-section">Storefront</div>
      <a href="<?= site_url('/') ?>" class="op-nav-link"><span>Beranda Toko</span></a>
      <a href="<?= site_url('products') ?>" class="op-nav-link"><span>Katalog Produk</span></a>

      <div class="mt-auto p-3 border-top border-light border-opacity-10 small">
        <div class="text-white fw-semibold text-truncate"><?= esc(session()->get('user_name')) ?></div>
        <div class="text-uppercase opacity-75"><?= esc($role) ?> · <?= esc(session()->get('user_email')) ?></div>
      </div>
    </aside>

    <div class="op-main">
      <header class="op-topbar">
        <h1 class="h5 fw-bold mb-0"><?= esc($title ?? 'Dashboard') ?></h1>
        <div class="d-flex align-items-center gap-2">
          <span class="role-pill"><?= esc($role) ?></span>
          <a href="<?= site_url('/') ?>" class="btn btn-sm btn-outline-dark">Lihat Toko</a>
          <form action="<?= site_url('logout') ?>" method="post" class="d-inline">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
          </form>
        </div>
      </header>

      <main class="op-content">
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

        <?= $this->renderSection('content') ?>
      </main>
    </div>
  </div>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
