<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SpatieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([SpatieSeeder::class]);
        
        // \App\Models\User::factory(10)->create();
    }
}
