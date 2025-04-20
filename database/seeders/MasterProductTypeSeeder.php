<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductType;

class MasterProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(['name' => 'Device', 'created_by' => 'SYSTEM']);
        ProductType::create(['name' => 'Terrea', 'created_by' => 'SYSTEM']);
    }
}
