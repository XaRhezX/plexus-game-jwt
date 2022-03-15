<?php

namespace Database\Seeders;

use App\Models\Coin;
use App\Models\CoinTransaction;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinSeeder extends Seeder
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

        for ($i=0; $i < $generate; $i++) {
            $coin = Coin::firstOrCreate([
                'game_id'   => $game[array_rand($game, 1)],
                'user_id'   => $user[array_rand($user, 1)],
            ]);
            $coin->CoinTransactions()->create([
                'total' => rand(1, 100)
            ]);
        }

        $coins = Coin::withSum('CoinTransactions', 'total')->get();
        foreach ($coins as $coin) {
            $coin->update([
                'total' => $coin->coin_transactions_sum_total
            ]);
        }
    }
}
