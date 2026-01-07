<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements OnEachRow, WithHeadingRow
{
    /**
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        // Find by name and category (as a simple unique constraint for import)
        Product::updateOrCreate(
            [
                'name' => $row['name'] ?? null,
                'category' => $row['category'] ?? null,
            ],
            [
                'description' => $row['description'] ?? null,
                'price' => $row['price'] ?? null,
                'stock' => $row['stock'] ?? 0,
                'image' => $row['image'] ?? config('app.default_product_image'),
                'is_active' => $row['is_active'] ?? 1,
            ]
        );
    }
}
