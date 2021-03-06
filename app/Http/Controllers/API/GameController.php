<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Traits\ApiResponse;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class GameController extends Controller
{
    use ApiResponse;

    public function index(Request $request){
        $paginate = ($request->input('page_size')) ? $request->input('page_size') : 10;
        $game = Game::where('name','like', '%'.$request->q. '%')->simplePaginate($paginate);
        return $this->success($game);
    }

    public function show(Game $game){
        return $this->success($game);
    }
}
