<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InventarisCondition;

class InventarisConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventarisCondition::create(['name' => 'Baik', 'created_by' => 'SYSTEM']);
        InventarisCondition::create(['name' => 'Rusak', 'created_by' => 'SYSTEM']);
    }
}
