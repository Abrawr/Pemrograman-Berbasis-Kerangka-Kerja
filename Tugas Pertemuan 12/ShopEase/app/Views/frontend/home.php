<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<section class="se-hero p-4 p-lg-5 mb-5">
  <div class="row g-4 align-items-center">
    <div class="col-lg-6">
      <h1 class="mb-3">Perlengkapan Cerdas untuk Aktivitas Kampus &amp; Kerja</h1>
      <p class="se-hero-lead mb-4">
        Katalog pilihan kategori elektronik, fashion, aksesoris, hingga perlengkapan meja belajar dengan stok terpantau dan pengiriman terukur.
      </p>
      <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= site_url('products') ?>" class="btn btn-cta btn-lg px-4">Jelajahi Katalog</a>
        <a href="<?= site_url('about') ?>" class="btn btn-outline-light btn-lg px-4">Arsitektur MVC</a>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <?php foreach ($categories as $cat): ?>
          <a href="<?= site_url('category/' . $cat['slug']) ?>" class="se-hero-pill">
            <?= esc($cat['name']) ?> (<?= esc($cat['count']) ?>)
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="row g-3">
        <div class="col-12">
          <a href="<?= site_url('products/' . $spotlightLeft['slug']) ?>" class="surface-card p-3 d-flex align-items-center gap-3 text-decoration-none text-dark">
            <div class="bg-light rounded p-2 flex-shrink-0" style="width: 112px; height: 84px; display:flex; align-items:center; justify-content:center;">
              <img src="<?= base_url($spotlightLeft['image']) ?>" alt="<?= esc($spotlightLeft['name']) ?>" style="max-height:72px; width:auto;">
            </div>
            <div class="min-w-0 flex-grow-1">
              <div class="se-mono text-secondary"><?= esc($spotlightLeft['sku']) ?> · <?= esc($spotlightLeft['category_name']) ?></div>
              <div class="fw-bold fs-6 text-truncate"><?= esc($spotlightLeft['name']) ?></div>
              <div class="fw-bold tabular-nums" style="color: var(--se-cta);"><?= esc(format_rupiah($spotlightLeft['price'])) ?></div>
            </div>
          </a>
        </div>
        <?php foreach ($spotlightRight as $sp): ?>
          <div class="col-sm-6">
            <a href="<?= site_url('products/' . $sp['slug']) ?>" class="surface-card p-3 d-block text-decoration-none text-dark h-100">
              <div class="bg-light rounded p-2 text-center mb-2">
                <img src="<?= base_url($sp['image']) ?>" alt="<?= esc($sp['name']) ?>" style="max-height:76px; width:auto;">
              </div>
              <div class="small text-secondary"><?= esc($sp['category_name']) ?></div>
              <div class="fw-bold text-truncate"><?= esc($sp['name']) ?></div>
              <div class="fw-bold small tabular-nums mt-1" style="color: var(--se-pine);"><?= esc(format_rupiah($sp['price'])) ?></div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="mb-5">
  <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
    <div>
      <h2 class="h4 fw-bold mb-1">Jelajahi per Kategori</h2>
      <p class="text-secondary small mb-0">Pilih kategori untuk menyaring katalog menggunakan named route <code>/category/{slug}</code>.</p>
    </div>
    <a href="<?= site_url('products') ?>" class="btn btn-sm btn-outline-dark">Lihat Semua Produk</a>
  </div>
  <div class="row g-3">
    <?php foreach ($categories as $cat): ?>
      <div class="col-sm-6 col-lg-3">
        <a href="<?= site_url('category/' . $cat['slug']) ?>" class="surface-card p-3 d-block text-decoration-none text-dark h-100 product-card">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="h6 fw-bold mb-0"><?= esc($cat['name']) ?></h3>
            <span class="badge text-bg-light border text-dark tabular-nums"><?= esc($cat['count']) ?> item</span>
          </div>
          <p class="small text-secondary mb-0"><?= esc($cat['description']) ?></p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="mb-5">
  <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
    <div>
      <h2 class="h4 fw-bold mb-1">Produk Pilihan Katalog</h2>
      <p class="text-secondary small mb-0">Menampilkan 8 dari 12 item katalog awal ShopEase.</p>
    </div>
    <a href="<?= site_url('products') ?>" class="btn btn-sm btn-pine">Buka Katalog Lengkap</a>
  </div>

  <div class="row g-4">
    <?php foreach ($latestProducts as $product): ?>
      <div class="col-sm-6 col-lg-3">
        <?= view('partials/product_card', ['product' => $product]) ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="surface-card p-4">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="d-flex align-items-start gap-3">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#123524" stroke-width="1.6" class="flex-shrink-0 mt-1" aria-hidden="true">
          <path d="M3 7h13v10H3z"/><path d="M16 10h4l2 3v4h-6z"/><circle cx="7.5" cy="18.5" r="1.5"/><circle cx="18.5" cy="18.5" r="1.5"/>
        </svg>
        <div>
          <h3 class="h6 fw-bold mb-1">Pengiriman Terjadwal</h3>
          <p class="small text-secondary mb-0">Pesanan diproses di hari yang sama dengan nomor resi yang terpantau.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex align-items-start gap-3">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#123524" stroke-width="1.6" class="flex-shrink-0 mt-1" aria-hidden="true">
          <path d="M12 3l8 4v5c0 5-3.4 8.5-8 10-4.6-1.5-8-5-8-10V7l8-4z"/><path d="m9 12 2 2 4-4"/>
        </svg>
        <div>
          <h3 class="h6 fw-bold mb-1">Kualitas Terkurasi</h3>
          <p class="small text-secondary mb-0">Seluruh SKU elektronik dan aksesori telah melewati uji fungsi dasar.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex align-items-start gap-3">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#123524" stroke-width="1.6" class="flex-shrink-0 mt-1" aria-hidden="true">
          <path d="M4 12a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-6h4"/><path d="M4 13h4v6H6a2 2 0 0 1-2-2v-5z"/>
        </svg>
        <div>
          <h3 class="h6 fw-bold mb-1">Dukungan Pelanggan</h3>
          <p class="small text-secondary mb-0">Hubungi layanan bantuan langsung melalui halaman kontak untuk penukaran ukuran.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
