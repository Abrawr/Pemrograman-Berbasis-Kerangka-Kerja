<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4 mb-4">
  <h1 class="h3 fw-bold mb-2">Tentang ShopEase &amp; Arsitektur RCV</h1>
  <p class="text-secondary mb-4" style="max-width: 70ch;">
    ShopEase adalah studi kasus aplikasi toko online pada mata kuliah Pemrograman Berbasis Kerangka Kerja (PBKK C).
    Pada tahap Pertemuan 10 (Materi 19), fokus implementasi berada pada pemisahan <strong>Routing</strong>, <strong>Controller</strong>, dan <strong>View</strong> dengan auto-routing dinonaktifkan.
  </p>

  <h2 class="h5 fw-bold mb-3">Daftar Rute Eksplisit (<code>app/Config/Routes.php</code>)</h2>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>Metode &amp; Pola URL</th>
          <th>Controller :: Method</th>
          <th>Nama Route</th>
          <th>Fungsi</th>
        </tr>
      </thead>
      <tbody>
        <tr><td class="se-mono">GET /</td><td class="se-mono">HomeController::index</td><td><code>home</code></td><td>Landing page utama &amp; spotlight produk</td></tr>
        <tr><td class="se-mono">GET /products</td><td class="se-mono">ProductController::index</td><td><code>products.index</code></td><td>Katalog lengkap dengan filter pencarian &amp; urutan harga</td></tr>
        <tr><td class="se-mono">GET /category/{slug}</td><td class="se-mono">ProductController::category</td><td><code>category.show</code></td><td>Penyaringan produk per kategori + 404 jika tidak valid</td></tr>
        <tr><td class="se-mono">GET /products/{slug}</td><td class="se-mono">ProductController::detail</td><td><code>products.detail</code></td><td>Detail produk, spesifikasi, dan produk terkait</td></tr>
        <tr><td class="se-mono">GET /about</td><td class="se-mono">HomeController::about</td><td><code>about</code></td><td>Informasi platform &amp; arsitektur RCV</td></tr>
        <tr><td class="se-mono">GET / POST /contact</td><td class="se-mono">HomeController::contact / submitContact</td><td><code>contact</code></td><td>Formulir kontak terproteksi CSRF dan validasi</td></tr>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
