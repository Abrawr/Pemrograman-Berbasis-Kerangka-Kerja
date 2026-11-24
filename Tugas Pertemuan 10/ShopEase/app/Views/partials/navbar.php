<?php $activeMenu = $activeMenu ?? 'home'; ?>
<nav class="navbar navbar-expand-lg se-navbar navbar-dark py-2">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
        <path d="M5 8h14l-1.2 11H6.2L5 8z"/>
        <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
      </svg>
      <span>ShopEase</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#seNav" aria-label="Buka navigasi">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse gap-3" id="seNav">
      <ul class="navbar-nav me-auto gap-1 mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= nav_active($activeMenu, 'home') ?>" href="<?= site_url('/') ?>">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= nav_active($activeMenu, 'products') ?>" href="<?= site_url('products') ?>">Katalog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= nav_active($activeMenu, 'about') ?>" href="<?= site_url('about') ?>">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= nav_active($activeMenu, 'contact') ?>" href="<?= site_url('contact') ?>">Kontak</a>
        </li>
      </ul>

      <form action="<?= site_url('products') ?>" method="get" class="d-flex gap-2 se-search-bar mt-2 mt-lg-0" role="search">
        <input type="search" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control form-control-sm" placeholder="Cari produk atau SKU..." aria-label="Cari produk">
        <button type="submit" class="btn btn-sm btn-cta px-3">Cari</button>
      </form>
    </div>
  </div>
</nav>
