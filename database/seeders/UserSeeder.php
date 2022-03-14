<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Administrator',
            'email' => 'super@admin.dev',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('super@admin.dev')
        ]);
        User::factory(100)->create();
    }
}
