<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImportUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_without_errors()
    {
        $rows = new Collection([
            collect([
                'name'        => 'Imported Product',
                'category'    => 'Electronics',
                'price'       => 299.99,
                'description' => 'Bulk import item',
                'stock'       => 5,
                'image'       => 'test.jpg',
            ]),
        ]);

        (new ProductImport())->collection($rows);

        $this->assertTrue(true);
    }

    public function test_import_skips_rows_with_missing_required_fields()
    {
        $rows = new Collection([
            collect([
                'name'     => '',
                'category' => '',
                'price'    => 100,
            ]),
        ]);

        (new ProductImport())->collection($rows);

        $this->assertDatabaseCount('products', 0);
    }

    public function test_import_skips_rows_with_incorrect_price()
    {
        $rows = new Collection([
            collect([
                'name'     => 'Invalid Price Product',
                'category' => 'Electronics',
                'price'    => 'abc',
            ]),
        ]);

        (new ProductImport())->collection($rows);

        $this->assertDatabaseCount('products', 0);
    }

    public function test_import_does_not_update_existing_product_without_unique_constraint()
    {
        Product::create([
            'name'     => 'Laptop',
            'category' => 'Electronics',
            'price'    => 500,
            'stock'    => 2,
        ]);

        $rows = new Collection([
            collect([
                'name'     => 'Laptop',
                'category' => 'Electronics',
                'price'    => 450,
                'stock'    => 10,
            ]),
        ]);

        (new ProductImport())->collection($rows);

        $product = Product::first();

        // Assert original record remains unchanged
        $this->assertEquals(500, (float) $product->price);
        $this->assertEquals(2, $product->stock);
        $this->assertEquals(1, Product::count());
    }
}
