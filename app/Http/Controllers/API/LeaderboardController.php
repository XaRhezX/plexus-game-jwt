<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Experience;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LeaderboardController extends Controller
{
    use ApiResponse;

    public function getLeaderboardExp(Request $request){

        $paginate = ($request->input('page_size')) ? $request->input('page_size') : 10;
        $game = Experience::with(['Game','User'])->orderBy('total','desc')->simplePaginate($paginate);
        return $this->success($game);

    }


    public function getLeaderboardExpByGame(Request $request){
        $validator = Validator::make(
            $request->all(),
            ['game_id' => 'required|exists:games,id']
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }


        $paginate = ($request->input('page_size')) ? $request->input('page_size') : 10;
        $game = Experience::with(['Game','User'])
        ->whereGameId($request->game_id)
        ->orderBy('total','desc')
        ->simplePaginate($paginate);
        return $this->success($game);

    }


    public function getLeaderboardCoin(Request $request){

        $paginate = ($request->input('page_size')) ? $request->input('page_size') : 10;
        $game = Coin::with(['Game','User'])->orderBy('total','desc')->simplePaginate($paginate);
        return $this->success($game);

    }


    public function getLeaderboardCoinByGame(Request $request){
        $validator = Validator::make(
            $request->all(),
            ['game_id' => 'required|exists:games,id']
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }


        $paginate = ($request->input('page_size')) ? $request->input('page_size') : 10;
        $game = Coin::with(['Game','User'])
        ->whereGameId($request->game_id)
        ->orderBy('total','desc')
        ->simplePaginate($paginate);
        return $this->success($game);

    }
}
