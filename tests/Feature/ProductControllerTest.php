<?php
namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_displays_all_products()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    #[Test]
    public function create_displays_product_creation_form()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Create Product');
    }

    #[Test]
    public function store_creates_a_product()
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Test Product',
            'quantity' => 5,
            'price' => 100.50,
            'description' => 'Test product description.',
            'expiration_date' => '2025-12-31',
            'status' => 'available'
        ]);

        $response->assertStatus(302);  // Expected redirect
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'quantity' => 5,
            'price' => 100.50
        ]);
    }

    #[Test]
    public function show_displays_product_details()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    #[Test]
    public function edit_displays_product_edit_form()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertSee('Edit Product');
        $response->assertSee($product->name);
    }

    #[Test]
    public function update_modifies_existing_product()
    {
        $product = Product::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => 'Updated Product',
            'quantity' => 10,
            'price' => 150.00,
            'description' => 'Updated description.',
            'expiration_date' => '2025-12-31',
            'status' => 'unavailable'
        ]);

        $response->assertStatus(302); // Expected redirect
        $this->assertDatabaseHas('products', [
            'name' => 'Updated Product',
            'quantity' => 10,
            'price' => 150.00
        ]);
    }

    #[Test]
    public function destroy_deletes_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertStatus(302); // Expected redirect
        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
