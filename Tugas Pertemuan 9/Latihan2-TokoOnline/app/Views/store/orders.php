<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 fw-bold mb-0">Riwayat Pesanan</h1>
    <a href="<?= site_url('/') ?>" class="btn btn-sm btn-outline-secondary">Kembali ke Katalog</a>
  </div>

  <?php if (empty($orders)): ?>
    <div class="text-center py-4 text-secondary">Belum ada pesanan tercatat.</div>
  <?php else: ?>
    <div class="d-flex flex-column gap-3">
      <?php foreach ($orders as $ord): ?>
        <div class="border rounded p-3 bg-light-subtle">
          <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
            <div>
              <span class="fw-bold tabular-nums"><?= esc($ord['order_code']) ?></span>
              <span class="text-secondary small ms-2"><?= esc($ord['customer_name']) ?> (<?= esc($ord['customer_email']) ?>)</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="badge text-bg-success"><?= esc($ord['status']) ?></span>
              <strong class="tabular-nums">Rp <?= number_format((int) $ord['total_amount'], 0, ',', '.') ?></strong>
            </div>
          </div>
          <div class="small text-secondary mb-2">Alamat: <?= esc($ord['shipping_address']) ?></div>
          <ul class="small mb-0 ps-3">
            <?php foreach ($ord['items'] as $it): ?>
              <li><?= esc($it['product_name']) ?> — <?= esc($it['qty']) ?> × Rp <?= number_format((int) $it['price'], 0, ',', '.') ?> (Subtotal: Rp <?= number_format((int) $it['subtotal'], 0, ',', '.') ?>)</li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
