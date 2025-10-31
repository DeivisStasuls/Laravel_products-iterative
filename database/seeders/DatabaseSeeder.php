<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Šeit pievieno ProductSeeder
        $this->call(ProductSeeder::class);

        // Ja vēlāk būs citi seederi, tos var pievienot šeit
        // $this->call(AnotherSeeder::class);
    }
}
