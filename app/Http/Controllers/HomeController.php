<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $top_game = Game::WithSum('Experiences','total')->WithSum('Coins','total')
        ->orderBy(DB::raw('experiences_sum_total+coins_sum_total'),'desc')->simplePaginate(10);

        $user_exp = User::WithSum('Experiences','total')
        ->orderBy('experiences_sum_total','desc')
        ->simplePaginate(10);

        $user_coin = User::WithSum('Coins','total')
        ->orderBy('coins_sum_total','desc')
        ->simplePaginate(10);

        return view('home',compact('user_exp','user_coin','top_game'));
    }
}
