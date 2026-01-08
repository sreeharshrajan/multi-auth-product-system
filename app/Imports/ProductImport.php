<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithChunkReading,
    WithStartRow,
    WithHeadingRow
};
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductImport implements
    ToCollection,
    WithChunkReading,
    WithStartRow,
    WithHeadingRow,
    ShouldQueue
{
    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows): void
    {
        $now = now();
        $payload = [];

        foreach ($rows as  $index => $row) {
            if ($row->filter()->isEmpty()) {
                continue;
            }

            if (
                empty($row['name']) ||
                empty($row['category']) ||
                !is_numeric($row['price'])
            ) {
                continue;
            }

            $data[] = [
                'name'        => trim($row['name'] ?? ''),
                'category'    => trim($row['category'] ?? ''),
                'price'       => $row['price'] ?? null,
                'description' => $row['description'] ?? null,
                'stock'       => $row['stock'] ?? 0,
                'image'       => $row['image'] ?? config('app.default_product_image'),
            ];

            /** Row-level validation */
            $validator = Validator::make($data, [
                'name'      => 'required|string|max:255',
                'category'  => 'required|string|max:255',
                'price'     => 'required|numeric|min:0',
                'stock'     => 'nullable|integer|min:0',
                'image'     => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::warning('Product import row failed validation', [
                    'row_number' => $index + 2, // Excel row number
                    'errors'     => $validator->errors()->toArray(),
                    'row'        => $row->toArray(),
                ]);

                continue; // Skip invalid row
            }
            $payload[] = [
                ...$data,
                'price'      => (float) $data['price'],
                'stock'      => (int) $data['stock'],
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (! empty($payload)) {
            Product::upsert(
                $payload,
                ['name', 'category'],
                ['price', 'description', 'stock', 'image', 'is_active', 'updated_at']
            );
        }
    }
}
