<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_displays_all_products()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'quantity' => 10,
            'description' => 'Test desc',
            'expiration_date' => now()->addDays(10),
            'status' => 'available',
            'price' => 99.99,
        ]);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Test Product');
    }

    /** @test */
    public function create_returns_view()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    /** @test */
    public function store_creates_product_and_redirects()
    {
        $data = [
            'name' => 'New Product',
            'quantity' => 5,
            'description' => 'A description',
            'expiration_date' => now()->addDays(5)->toDateString(),
            'status' => 'available',
            'price' => 49.99,
        ];

        $response = $this->post(route('products.store'), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    /** @test */
    public function show_displays_product()
    {
        $product = Product::create([
            'name' => 'Show Product',
            'quantity' => 5,
            'description' => 'Desc',
            'expiration_date' => now()->addDays(5),
            'status' => 'available',
            'price' => 20,
        ]);

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertSeeText('Show Product');
    }

    /** @test */
    public function edit_returns_edit_view()
    {
        $product = Product::create([
            'name' => 'Edit Product',
            'quantity' => 2,
            'description' => 'Edit desc',
            'expiration_date' => now()->addDays(2),
            'status' => 'available',
            'price' => 15,
        ]);

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertViewIs('products.edit');
    }

    /** @test */
    public function update_modifies_product_and_redirects()
    {
        $product = Product::create([
            'name' => 'Old Name',
            'quantity' => 1,
            'description' => 'Old desc',
            'expiration_date' => now(),
            'status' => 'available',
            'price' => 10,
        ]);

        $data = [
            'name' => 'Updated Name',
            'quantity' => 3,
            'description' => 'Updated desc',
            'expiration_date' => now()->addDays(10)->toDateString(),
            'status' => 'available',
            'price' => 20,
        ];

        $response = $this->put(route('products.update', $product), $data);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Updated Name', 'quantity' => 3]);
    }

    /** @test */
    public function destroy_deletes_product_and_redirects()
    {
        $product = Product::create([
            'name' => 'Delete Me',
            'quantity' => 1,
            'description' => 'To delete',
            'expiration_date' => now(),
            'status' => 'available',
            'price' => 10,
        ]);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['name' => 'Delete Me']);
    }

    /** @test */
    public function adjust_quantity_increases_and_decreases_quantity()
{
    $product = Product::create([
        'name' => 'Quantity Test',
        'quantity' => 5,
        'description' => 'Qty desc',
        'expiration_date' => now(),
        'status' => 'available',
        'price' => 10,
    ]);

    // Increase
    $this->get(route('products.adjust', ['product' => $product->id, 'action' => 'increase']));
    $product->refresh();
    $this->assertEquals(6, $product->quantity);

    // Decrease
    $this->get(route('products.adjust', ['product' => $product->id, 'action' => 'decrease']));
    $product->refresh();
    $this->assertEquals(5, $product->quantity);
}
}
