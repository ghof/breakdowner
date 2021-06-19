<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BreakdownSeeder::class,
        ]);
        Artisan::call('passport:client --user_id=1 --password --name=ekarClientName --provider=users');
        $this->command->info(Artisan::output());
    }
}
