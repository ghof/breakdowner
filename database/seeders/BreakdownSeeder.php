<?php

namespace Database\Seeders;

use App\Models\Breakdown;
use Illuminate\Database\Seeder;

class BreakdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Breakdown::factory(10)->create();
    }
}
