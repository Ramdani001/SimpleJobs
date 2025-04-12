<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MasterParameter;

class MasterParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterParameter::create([
            'code' => 'TARGET_DEVICE',
            'description' => 'Target Device',
            'value' => '0',
        ]);

        MasterParameter::create([
            'code' => 'FINANCIAL_TARGET',
            'description' => 'Financial Target',
            'value' => '0',
        ]);
    }
}
