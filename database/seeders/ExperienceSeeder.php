<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\ExperienceTransaction;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->pluck('id')->toArray();
        $game = Game::all()->pluck('id')->toArray();

        $generate = 1000;

        for ($i = 0; $i < $generate; $i++) {
            $experience = Experience::firstOrCreate([
                'game_id'   => $game[array_rand($game, 1)],
                'user_id'   => $user[array_rand($user, 1)],
            ]);
            $experience->experienceTransactions()->create([
                'total' => rand(1, 100)
            ]);
        }

        $experiences = Experience::withSum('ExperienceTransactions', 'total')->get();
        foreach ($experiences as $experience) {
            $experience->update([
                'total' => $experience->experience_transactions_sum_total
            ]);
        }
    }
}
