<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="row g-4 mb-5">
  <div class="col-lg-5">
    <div class="surface-card p-4 h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 fw-bold mb-0">Profil Akun Saya</h1>
        <span class="badge text-bg-success text-uppercase"><?= esc($user['role']) ?></span>
      </div>
      <table class="table table-sm mb-3">
        <tbody>
          <tr><th class="text-secondary fw-medium" style="width: 130px;">Nama</th><td class="fw-semibold"><?= esc($user['name']) ?></td></tr>
          <tr><th class="text-secondary fw-medium">Email</th><td><?= esc($user['email']) ?></td></tr>
          <tr><th class="text-secondary fw-medium">Telepon</th><td class="tabular-nums"><?= esc($user['phone'] ?? '-') ?></td></tr>
          <tr><th class="text-secondary fw-medium">Masuk Sejak</th><td class="tabular-nums small"><?= esc($user['login_at'] ?? '-') ?></td></tr>
        </tbody>
      </table>
      <div class="d-flex flex-wrap gap-2">
        <?php if ($user['role'] === 'admin'): ?>
          <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-sm btn-pine">Ke Dashboard Admin</a>
        <?php elseif ($user['role'] === 'operator'): ?>
          <a href="<?= site_url('operator/dashboard') ?>" class="btn btn-sm btn-pine">Ke Panel Operator</a>
        <?php endif; ?>
        <a href="<?= site_url('products') ?>" class="btn btn-sm btn-cta">Belanja di Katalog</a>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="surface-card p-4 h-100">
      <h2 class="h5 fw-bold mb-2">Keamanan Sesi &amp; Otorisasi</h2>
      <p class="small text-secondary mb-3">
        Sesi autentikasi menggunakan ID sesi yang diregenerasi saat login (<code>session()-&gt;regenerate(true)</code>), kata sandi di-hash menggunakan <code>PASSWORD_BCRYPT</code>, dan setiap logout hanya diizinkan lewat permintaan <code>POST</code> dengan token CSRF.
      </p>
      <form action="<?= site_url('logout') ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-outline-danger btn-sm">Keluar dari Akun (Logout POST)</button>
      </form>
    </div>
  </div>
</div>

<section>
  <h2 class="h5 fw-bold mb-3">Rekomendasi Produk untuk Anda</h2>
  <div class="row g-4">
    <?php foreach ($recommendations as $product): ?>
      <div class="col-sm-6 col-lg-3">
        <?= view('partials/product_card', ['product' => $product]) ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?= $this->endSection() ?>
