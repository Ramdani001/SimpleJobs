<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductStatus;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductStatus::create([
            'name' => 'Ready',
            'is_active' => true
        ]);

        ProductStatus::create([
            'name' => 'Sold Out',
            'is_active' => true
        ]);
    }
}
