<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Katalog</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('/?kategori=' . urlencode($product['category_slug'])) ?>"><?= esc($product['category_name']) ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= esc($product['name']) ?></li>
  </ol>
</nav>

<div class="surface-card p-4">
  <div class="row g-4 align-items-center">
    <div class="col-md-5">
      <div class="bg-light rounded p-4 text-center border">
        <img src="<?= base_url($product['image'] ?: 'assets/images/produk-headset.svg') ?>" alt="<?= esc($product['name']) ?>" class="img-fluid" style="max-height: 260px;">
      </div>
    </div>
    <div class="col-md-7">
      <div class="small text-secondary mb-1">SKU: <span class="tabular-nums fw-semibold"><?= esc($product['sku']) ?></span> · <?= esc($product['category_name']) ?></div>
      <h1 class="h3 fw-bold mb-2"><?= esc($product['name']) ?></h1>
      <div class="fs-3 fw-bold text-success tabular-nums mb-3">Rp <?= number_format((int) $product['price'], 0, ',', '.') ?></div>
      <p class="text-secondary mb-3"><?= esc($product['description']) ?></p>
      <p class="mb-4">Stok Tersedia: <strong class="tabular-nums"><?= esc($product['stock']) ?> unit</strong></p>

      <form action="<?= site_url('cart/add') ?>" method="post" class="d-flex flex-wrap align-items-center gap-2">
        <?= csrf_field() ?>
        <input type="hidden" name="product_id" value="<?= esc($product['id']) ?>">
        <label for="qty" class="visually-hidden">Jumlah</label>
        <input type="number" id="qty" name="qty" value="1" min="1" max="<?= max(1, (int) $product['stock']) ?>" class="form-control tabular-nums" style="width: 96px;">
        <button type="submit" class="btn btn-emerald" <?= (int) $product['stock'] < 1 ? 'disabled' : '' ?>>Masukkan Keranjang</button>
        <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary">Kembali ke Katalog</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
