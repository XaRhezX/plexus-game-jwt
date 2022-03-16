<?php

namespace Database\Seeders;

use App\Models\RestApiLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestApiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestApiLog::factory(1000)->create();
    }
}
