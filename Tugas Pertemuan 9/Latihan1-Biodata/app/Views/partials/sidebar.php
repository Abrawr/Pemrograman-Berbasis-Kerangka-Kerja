<?php $activeMenu = $activeMenu ?? 'home'; ?>
<aside class="app-sidebar">
  <div class="app-brand">
    <a href="<?= site_url('/') ?>" class="app-brand-title">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
        <rect x="3" y="4" width="18" height="16" rx="2"/>
        <path d="M9 4v16M3 10h6"/>
      </svg>
      <span>PBKK Latihan 1</span>
    </a>
  </div>

  <div class="app-nav-label">Navigasi Utama</div>
  <a href="<?= site_url('/') ?>" class="app-nav-link <?= $activeMenu === 'home' ? 'active' : '' ?>">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
      <path d="M3 10.5L12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/>
    </svg>
    <span>Biodata &amp; Modul</span>
  </a>
  <a href="<?= site_url('about') ?>" class="app-nav-link <?= $activeMenu === 'about' ? 'active' : '' ?>">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
      <circle cx="12" cy="12" r="9"/><path d="M12 16v-4m0-4h.01"/>
    </svg>
    <span>About (MVC)</span>
  </a>
  <a href="<?= site_url('contact') ?>" class="app-nav-link <?= $activeMenu === 'contact' ? 'active' : '' ?>">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
      <path d="M4 6h16v12H4z"/><path d="m4 7 8 6 8-6"/>
    </svg>
    <span>Contact (Form)</span>
  </a>

  <div class="app-nav-label">Modul Data &amp; Berkas</div>
  <a href="<?= site_url('catatan') ?>" class="app-nav-link <?= $activeMenu === 'catatan' ? 'active' : '' ?>">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
      <path d="M8 6h12M8 12h12M8 18h12M4 6h.01M4 12h.01M4 18h.01"/>
    </svg>
    <span>Catatan CRUD</span>
  </a>
  <a href="<?= site_url('upload') ?>" class="app-nav-link <?= $activeMenu === 'upload' ? 'active' : '' ?>">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
    </svg>
    <span>Upload Berkas</span>
  </a>

  <div class="mt-auto p-3 border-top border-secondary-subtle small text-secondary">
    <div class="text-white fw-semibold">Abrar Maulana</div>
    <div class="tabular-nums">NRP 5025241125 · PBKK C</div>
  </div>
</aside>
