<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $productNames = [
            'Organic Almond Milk 1L',
            'Wireless Headphones Pro',
            'Bluetooth Speaker Mini',
            'Eco Cotton T-Shirt',
            'Smart LED Lamp',
            'Reusable Water Bottle 750ml',
            'Noise Cancelling Earbuds',
            'Portable Charger 10000mAh',
            'Fitness Tracker Watch',
            'Herbal Shampoo 250ml',
            'Luxury Scented Candle',
            'Gourmet Dark Chocolate 100g',
            'Smartphone Stand Adjustable',
            'Laptop Sleeve 15 inch',
            'Organic Green Tea 50g',
            'Wireless Mouse Ergonomic',
            'Desk Organizer Set',
            'LED Desk Lamp with USB',
            'Travel Backpack 20L',
            'Ceramic Coffee Mug 350ml'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($productNames),
            'price' => $this->faker->randomFloat(2, 5, 300), // no 5 līdz 300 EUR
            'quantity' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->sentence(12),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
