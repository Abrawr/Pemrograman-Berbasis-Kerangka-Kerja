<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="surface-card p-4">
      <h1 class="h4 fw-bold mb-3">Informasi Pengiriman &amp; Pembeli</h1>
      <form action="<?= site_url('checkout') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="customer_name" class="form-label fw-medium">Nama Penerima</label>
          <input type="text" id="customer_name" name="customer_name" class="form-control" value="<?= old('customer_name', 'Abrar Maulana') ?>" required>
        </div>
        <div class="mb-3">
          <label for="customer_email" class="form-label fw-medium">Email Konfirmasi</label>
          <input type="email" id="customer_email" name="customer_email" class="form-control" value="<?= old('customer_email', '5025241125@student.its.ac.id') ?>" required>
        </div>
        <div class="mb-3">
          <label for="shipping_address" class="form-label fw-medium">Alamat Pengiriman Lengkap</label>
          <textarea id="shipping_address" name="shipping_address" rows="3" class="form-control" required><?= old('shipping_address', 'Departemen Teknik Informatika ITS, Sukolilo, Surabaya') ?></textarea>
        </div>
        <button type="submit" class="btn btn-emerald">Konfirmasi &amp; Buat Pesanan</button>
      </form>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="surface-card p-4">
      <h2 class="h5 fw-bold mb-3">Ringkasan Pesanan</h2>
      <ul class="list-group list-group-flush mb-3">
        <?php foreach ($cart as $item): ?>
          <li class="list-group-item px-0 d-flex justify-content-between">
            <span><?= esc($item['name']) ?> × <strong class="tabular-nums"><?= esc($item['qty']) ?></strong></span>
            <span class="tabular-nums">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="d-flex justify-content-between fw-bold fs-5">
        <span>Total Bayar</span>
        <span class="text-success tabular-nums">Rp <?= number_format((int) $total, 0, ',', '.') ?></span>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
