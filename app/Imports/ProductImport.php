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
    protected static int $chunk = 0;

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
        self::$chunk++;

        $chunkNumber = self::$chunk;
        $rowCount = $rows->count();

        Log::info('Product import chunk started', [
            'chunk'     => $chunkNumber,
            'rows'      => $rowCount,
            'memory_mb' => round(memory_get_usage(true) / 1024 / 1024, 2),
        ]);

        $now = now();
        $payload = [];

        foreach ($rows as $index => $row) {

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

            $data = [
                'name'        => trim($row['name'] ?? ''),
                'category'    => trim($row['category'] ?? ''),
                'price'       => $row['price'] ?? null,
                'description' => $row['description'] ?? null,
                'stock'       => $row['stock'] ?? 0,
                'image'       => $row['image'] ?? config('app.default_product_image'),
            ];

            /** Row-level validation */
            $validator = Validator::make($data, [
                'name'     => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price'    => 'required|numeric|min:0',
                'stock'    => 'nullable|integer|min:0',
                'image'    => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::warning('Product import row failed validation', [
                    'row_number' => $index + 2, // Match with excel row number
                    'errors'     => $validator->errors()->toArray(),
                    'row'        => $row->toArray(),
                ]);
                continue; // Skip invalid rows
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

        $start = microtime(true);

        if (! empty($payload)) {
            Product::upsert(
                $payload,
                ['name', 'category'],
                ['price', 'description', 'stock', 'image', 'is_active', 'updated_at']
            );
        }

        Log::info('Product import chunk completed', [
            'chunk'      => $chunkNumber,
            'rows'       => $rowCount,
            'duration_s' => round(microtime(as_float: true) - $start, 2),
        ]);
    }
}
