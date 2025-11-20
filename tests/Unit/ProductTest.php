<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Resets DB after each test

    /** @test */
    public function a_product_can_be_created()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 99.99,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99,
        ]);
    }

    /** @test */
    public function a_product_requires_a_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([
            'description' => 'No name product',
            'price' => 50.00,
        ]);
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $product = Product::create([
            'name' => 'Old Name',
            'description' => 'Old description',
            'price' => 10.00,
        ]);

        $product->update([
            'name' => 'New Name',
            'price' => 20.00,
        ]);

        $this->assertEquals('New Name', $product->name);
        $this->assertEquals(20.00, $product->price);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $product = Product::create([
            'name' => 'Delete Me',
            'description' => 'To be deleted',
            'price' => 5.00,
        ]);

        $product->delete();

        $this->assertDatabaseMissing('products', [
            'name' => 'Delete Me',
        ]);
    }
}
