<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center py-3">
  <div class="col-md-7 col-lg-5">
    <div class="surface-card p-4 p-lg-5">
      <h1 class="h3 fw-bold mb-1">Masuk ke Akun ShopEase</h1>
      <p class="text-secondary small mb-4">Gunakan email dan password terdaftar untuk mengakses panel sesuai peran Anda.</p>

      <form action="<?= site_url('login') ?>" method="post" id="loginForm">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="email" class="form-label fw-medium">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="nama@shopease.test" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-medium">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
        </div>
        <button type="submit" class="btn btn-cta w-100 py-2">Masuk Sekarang</button>
      </form>

      <div class="mt-4 pt-3 border-top">
        <div class="small fw-semibold mb-2">Isi Cepat Akun Demo (Uji RBAC):</div>
        <div class="d-flex flex-wrap gap-2 mb-3">
          <button type="button" class="btn btn-sm btn-outline-dark" onclick="fillDemo('admin@shopease.test','Admin123!')">Admin</button>
          <button type="button" class="btn btn-sm btn-outline-dark" onclick="fillDemo('operator@shopease.test','Operator123!')">Operator</button>
          <button type="button" class="btn btn-sm btn-outline-dark" onclick="fillDemo('customer@shopease.test','Customer123!')">Customer</button>
        </div>
        <div class="small text-secondary">
          <div>Admin: <code>admin@shopease.test</code> / <code>Admin123!</code></div>
          <div>Operator: <code>operator@shopease.test</code> / <code>Operator123!</code></div>
          <div>Customer: <code>customer@shopease.test</code> / <code>Customer123!</code></div>
        </div>
      </div>

      <div class="mt-3 text-center small">
        Belum punya akun? <a href="<?= site_url('register') ?>" class="fw-semibold text-decoration-none">Daftar Pelanggan Baru</a>
      </div>
    </div>
  </div>
</div>

<script>
function fillDemo(email, password) {
  document.getElementById('email').value = email;
  document.getElementById('password').value = password;
}
</script>

<?= $this->endSection() ?>
