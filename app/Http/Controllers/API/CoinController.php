<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class CoinController extends Controller
{
    use ApiResponse;

    public function show(){
        $coins = Coin::with(['CoinTransactions'])->whereUserId(Auth()->id())->get()->makeHidden(['user_id','id', 'created_at']);
        return $this->success($coins);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'coin'      => 'required|integer|gt:0',
                'game_id'   => 'required|exists:games,id'
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $coin = Coin::firstOrCreate([
            'user_id' => Auth()->id(),
            'game_id' => $request->game_id
        ]);

        $coin->increment('total', $request->coin);
        $coin->coinTransactions()->create([
            'total' => $request->coin
        ]);

        $coins = Coin::with(['coinTransactions'])->whereUserId(Auth()->id())->get()->makeHidden(['user_id', 'id', 'created_at']);
        return $this->success($coins);
    }
}
