<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            RoleSeeder::class,
            GameSeeder::class,
            CoinSeeder::class,
            ExperienceSeeder::class,
            RestApiLogSeeder::class,
        ]);
    }
}
