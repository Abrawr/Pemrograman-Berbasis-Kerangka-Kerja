<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <h1 class="h4 fw-bold mb-3">Keranjang Belanja</h1>

  <?php if (empty($cart)): ?>
    <div class="text-center py-5 text-secondary">
      Keranjang belanja Anda masih kosong.
      <div class="mt-3"><a href="<?= site_url('/') ?>" class="btn btn-emerald">Mulai Belanja</a></div>
    </div>
  <?php else: ?>
    <form action="<?= site_url('cart/update') ?>" method="post">
      <?= csrf_field() ?>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Produk</th>
              <th class="text-end">Harga</th>
              <th class="text-center" style="width: 130px;">Jumlah</th>
              <th class="text-end">Subtotal</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $pid => $item): ?>
              <tr>
                <td class="fw-medium"><?= esc($item['name']) ?></td>
                <td class="text-end tabular-nums">Rp <?= number_format((int) $item['price'], 0, ',', '.') ?></td>
                <td class="text-center">
                  <input type="number" name="qty[<?= esc($pid) ?>]" value="<?= esc($item['qty']) ?>" min="0" max="<?= esc($item['stock']) ?>" class="form-control form-control-sm text-center tabular-nums">
                </td>
                <td class="text-end tabular-nums fw-semibold">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></td>
                <td class="text-end">
                  <button type="submit" form="remove-<?= esc($pid) ?>" class="btn btn-sm btn-outline-danger">Hapus</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" class="text-end">Total Belanja</th>
              <th class="text-end fs-5 text-success tabular-nums">Rp <?= number_format((int) $total, 0, ',', '.') ?></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="d-flex flex-wrap justify-content-between gap-2 mt-3">
        <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary">Tambah Produk Lain</a>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-outline-primary">Perbarui Jumlah</button>
          <a href="<?= site_url('checkout') ?>" class="btn btn-emerald">Lanjut Checkout</a>
        </div>
      </div>
    </form>

    <?php foreach ($cart as $pid => $item): ?>
      <form id="remove-<?= esc($pid) ?>" action="<?= site_url('cart/remove/' . $pid) ?>" method="post" class="d-none">
        <?= csrf_field() ?>
      </form>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
