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

if (! function_exists('unique_slug')) {
    function unique_slug(string $text, string $table, ?int $ignoreId = null): string
    {
        $base = strtolower(trim((string) preg_replace('/[^A-Za-z0-9-]+/', '-', $text), '-'));
        if ($base === '') {
            $base = 'item';
        }

        $db      = db_connect();
        $slug    = $base;
        $counter = 2;

        while (true) {
            $builder = $db->table($table)->where('slug', $slug);
            if ($ignoreId !== null) {
                $builder->where('id !=', $ignoreId);
            }
            if ($builder->countAllResults() === 0) {
                return $slug;
            }
            $slug = "{$base}-{$counter}";
            $counter++;
        }
    }
}
