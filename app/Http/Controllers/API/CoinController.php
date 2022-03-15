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

    public function show(Request $request){
        $user = JWTAuth::authenticate($request->bearerToken());
        if (!$user) return $this->error(401, 'Authorization Token not found');

        $coins = Coin::with(['CoinTransactions'])->whereUserId($user->id)->get()->makeHidden(['user_id','id', 'created_at']);
        $data = collect([
            'coin' => $coins
        ]);
        return $this->success($data);
    }

    public function store(Request $request)
    {
        $user = JWTAuth::authenticate($request->bearerToken());
        if (!$user) return $this->error(401, 'Authorization Token not found');

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

        $coins = Coin::with(['coinTransactions'])->whereUserId($user->id)->get()->makeHidden(['user_id', 'id', 'created_at']);
        $data = collect([
            'coin' => $coins
        ]);
        return $this->success($data);
    }
}
