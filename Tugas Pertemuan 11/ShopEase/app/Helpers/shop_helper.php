<?php

if (! function_exists('format_rupiah')) {
    function format_rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format((int) $amount, 0, ',', '.');
    }
}

if (! function_exists('nav_active')) {
    function nav_active(string $current, string $target): string
    {
        return $current === $target ? 'active' : '';
    }
}

if (! function_exists('stock_badge')) {
    function stock_badge(int $stock): array
    {
        if ($stock <= 0) {
            return ['label' => 'Stok Habis', 'class' => 'badge-out'];
        }
        if ($stock <= 5) {
            return ['label' => "Sisa {$stock} Unit", 'class' => 'badge-low'];
        }

        return ['label' => "Tersedia ({$stock})", 'class' => 'badge-ready'];
    }
}

if (! function_exists('discount_percent')) {
    function discount_percent(int $price, ?int $originalPrice): int
    {
        if (! $originalPrice || $originalPrice <= $price) {
            return 0;
        }

        return (int) round((($originalPrice - $price) / $originalPrice) * 100);
    }
}
