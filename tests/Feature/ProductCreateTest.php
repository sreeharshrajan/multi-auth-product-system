<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_active_product_with_image()
    {
        Storage::fake('public');

        $admin = Admin::factory()->create();

        $payload = [
            'name'        => 'Test Product',
            'price'       => 499,
            'stock'       => 100,
            'description' => 'Test product description',
            'is_active'   => true,
            'image'       => UploadedFile::fake()->image('product.jpg', 600, 600),
        ];

        $response = $this
            ->actingAs($admin, 'admin')
            ->post(route('admin.products.store'), $payload);

        // Assert – response
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHasNoErrors();

        // Assert – database count
        $this->assertDatabaseCount('products', 1);

        // Assert – database values
        $this->assertDatabaseHas('products', [
            'name'        => 'Test Product',
            'price'       => 499,
            'stock'       => 100,
            'description' => 'Test product description',
            'is_active'   => 1,
        ]);

        // Assert – image stored
        $product = Product::first();
        Storage::disk('public')->assertExists($product->image);
    }
}
