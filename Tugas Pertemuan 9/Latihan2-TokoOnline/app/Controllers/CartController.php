<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    private function getCart(): array
    {
        return session()->get('cart') ?? [];
    }

    private function cartCount(array $cart): int
    {
        return array_sum(array_column($cart, 'qty'));
    }

    public function index(): string
    {
        $cart  = $this->getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('store/cart', [
            'title'      => 'Keranjang Belanja',
            'activeMenu' => 'cart',
            'cart'       => $cart,
            'total'      => $total,
            'cartCount'  => $this->cartCount($cart),
        ]);
    }

    public function add()
    {
        $productId = (int) $this->request->getPost('product_id');
        $qty       = max(1, (int) $this->request->getPost('qty'));

        $product = (new ProductModel())->find($productId);
        if (! $product || (int) $product['stock'] < 1) {
            return redirect()->back()->with('error', 'Produk tidak tersedia atau stok habis.');
        }

        $cart = $this->getCart();
        $existingQty = $cart[$productId]['qty'] ?? 0;
        $newQty = min((int) $product['stock'], $existingQty + $qty);

        $cart[$productId] = [
            'id'    => $product['id'],
            'name'  => $product['name'],
            'slug'  => $product['slug'],
            'price' => (int) $product['price'],
            'stock' => (int) $product['stock'],
            'image' => $product['image'],
            'qty'   => $newQty,
        ];

        session()->set('cart', $cart);

        return redirect()->to(site_url('cart'))->with('success', "{$product['name']} ditambahkan ke keranjang.");
    }

    public function update()
    {
        $quantities = $this->request->getPost('qty') ?? [];
        $cart       = $this->getCart();
        $model      = new ProductModel();

        foreach ($quantities as $productId => $qty) {
            $pid = (int) $productId;
            if (! isset($cart[$pid])) {
                continue;
            }
            $val = (int) $qty;
            if ($val <= 0) {
                unset($cart[$pid]);
                continue;
            }
            $fresh = $model->find($pid);
            $maxStock = $fresh ? (int) $fresh['stock'] : $cart[$pid]['stock'];
            $cart[$pid]['qty'] = min($maxStock, $val);
        }

        session()->set('cart', $cart);

        return redirect()->to(site_url('cart'))->with('success', 'Jumlah keranjang berhasil diperbarui.');
    }

    public function remove(int $productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session()->set('cart', $cart);

        return redirect()->to(site_url('cart'))->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->to(site_url('/'))->with('error', 'Keranjang belanja masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('store/checkout', [
            'title'      => 'Checkout Pesanan',
            'activeMenu' => 'cart',
            'cart'       => $cart,
            'total'      => $total,
            'cartCount'  => $this->cartCount($cart),
        ]);
    }

    public function processCheckout()
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->to(site_url('/'))->with('error', 'Keranjang belanja kosong.');
        }

        $rules = [
            'customer_name'    => 'required|min_length[3]|max_length[120]',
            'customer_email'   => 'required|valid_email|max_length[120]',
            'shipping_address' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db           = db_connect();
        $productModel = new ProductModel();
        $orderModel   = new OrderModel();

        $db->transBegin();
        try {
            $total = 0;
            $lineItems = [];

            foreach ($cart as $pid => $item) {
                $product = $productModel->find((int) $pid);
                if (! $product || (int) $product['stock'] < (int) $item['qty']) {
                    throw new \RuntimeException("Stok produk {$item['name']} tidak mencukupi.");
                }

                $subtotal = (int) $product['price'] * (int) $item['qty'];
                $total   += $subtotal;

                $productModel->update((int) $pid, [
                    'stock' => (int) $product['stock'] - (int) $item['qty'],
                ]);

                $lineItems[] = [
                    'product_id'   => (int) $pid,
                    'product_name' => $product['name'],
                    'price'        => (int) $product['price'],
                    'qty'          => (int) $item['qty'],
                    'subtotal'     => $subtotal,
                ];
            }

            $orderCode = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
            $orderId   = $orderModel->insert([
                'order_code'       => $orderCode,
                'customer_name'    => trim((string) $this->request->getPost('customer_name')),
                'customer_email'   => trim((string) $this->request->getPost('customer_email')),
                'shipping_address' => trim((string) $this->request->getPost('shipping_address')),
                'total_amount'     => $total,
                'status'           => 'Diproses',
            ], true);

            $orderItemTbl = $db->table('order_items');
            foreach ($lineItems as $line) {
                $line['order_id'] = $orderId;
                $orderItemTbl->insert($line);
            }

            $db->transCommit();
            session()->remove('cart');

            return redirect()->to(site_url('orders'))
                ->with('success', "Pesanan {$orderCode} berhasil dibuat dan stok produk telah diperbarui.");
        } catch (\Throwable $e) {
            $db->transRollback();

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function orders(): string
    {
        $cart = $this->getCart();

        return view('store/orders', [
            'title'      => 'Riwayat Pesanan',
            'activeMenu' => 'orders',
            'orders'     => (new OrderModel())->getWithItems(),
            'cartCount'  => $this->cartCount($cart),
        ]);
    }
}
