<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4" style="max-width: 720px;">
  <h1 class="h4 fw-bold mb-3"><?= esc($title) ?></h1>
  <form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="sku" class="form-label fw-medium">SKU</label>
        <input type="text" id="sku" name="sku" class="form-control tabular-nums" value="<?= old('sku', $product['sku'] ?? '') ?>" required>
      </div>
      <div class="col-md-8">
        <label for="name" class="form-label fw-medium">Nama Produk</label>
        <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $product['name'] ?? '') ?>" required>
      </div>
      <div class="col-md-4">
        <label for="category_id" class="form-label fw-medium">Kategori</label>
        <?php $cid = (int) old('category_id', $product['category_id'] ?? 1); ?>
        <select id="category_id" name="category_id" class="form-select">
          <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $cid === (int) $c['id'] ? 'selected' : '' ?>><?= esc($c['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="price" class="form-label fw-medium">Harga (Rp)</label>
        <input type="number" id="price" name="price" min="1000" class="form-control tabular-nums" value="<?= old('price', $product['price'] ?? 100000) ?>" required>
      </div>
      <div class="col-md-4">
        <label for="stock" class="form-label fw-medium">Stok</label>
        <input type="number" id="stock" name="stock" min="0" class="form-control tabular-nums" value="<?= old('stock', $product['stock'] ?? 10) ?>" required>
      </div>
      <div class="col-md-8">
        <label for="image" class="form-label fw-medium">Ilustrasi Produk</label>
        <?php
          $imgOptions = [
              'assets/images/produk-headset.svg' => 'Headset',
              'assets/images/produk-keyboard.svg' => 'Keyboard',
              'assets/images/produk-jaket.svg' => 'Jaket',
              'assets/images/produk-sepatu.svg' => 'Sepatu',
              'assets/images/produk-tas.svg' => 'Tas Ransel',
              'assets/images/produk-tumbler.svg' => 'Tumbler',
              'assets/images/produk-buku.svg' => 'Buku Catatan',
              'assets/images/produk-pena.svg' => 'Paket Pena',
          ];
          $curImg = old('image', $product['image'] ?? 'assets/images/produk-headset.svg');
        ?>
        <select id="image" name="image" class="form-select">
          <?php foreach ($imgOptions as $path => $label): ?>
            <option value="<?= esc($path) ?>" <?= $curImg === $path ? 'selected' : '' ?>><?= esc($label) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= old('is_active', $product['is_active'] ?? 1) ? 'checked' : '' ?>>
          <label class="form-check-label" for="is_active">Tampilkan di Katalog</label>
        </div>
      </div>
      <div class="col-12">
        <label for="description" class="form-label fw-medium">Deskripsi Produk</label>
        <textarea id="description" name="description" rows="3" class="form-control"><?= old('description', $product['description'] ?? '') ?></textarea>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-emerald">Simpan Produk</button>
      <a href="<?= site_url('admin/products') ?>" class="btn btn-outline-secondary">Batal</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
