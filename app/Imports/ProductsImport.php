<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductsImport implements ShouldQueue
{
    use Queueable;

    public function import(array $rows)
    {
        foreach ($rows as $row) {
            $category = null;
            if (!empty($row['category'])) {
                $category = Category::firstOrCreate([
                    'name' => trim($row['category'])
                ]);
            }

            Product::create([
                'category_id' => $category?->id,
                'name'        => trim($row['name']),
                'description' => $row['description'] ?? null,
                'price'       => (float) $row['price'],
                'stock'       => (int) ($row['stock'] ?? 0),
                'image'       => $row['image'] ?: null,
            ]);
        }
    }
}
