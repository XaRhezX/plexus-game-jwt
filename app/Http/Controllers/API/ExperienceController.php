<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExperienceController extends Controller
{
    use ApiResponse;

    public function show(Request $request)
    {
        $user = JWTAuth::authenticate($request->bearerToken());
        if (!$user) return $this->error(401, 'Authorization Token not found');

        $coins = Experience::with(['ExperienceTransactions'])->whereUserId($user->id)->get()->makeHidden(['user_id', 'id', 'created_at']);
        $data = collect([
            'experience' => $coins
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
                'experience'      => 'required|integer|gt:0',
                'game_id'   => 'required|exists:games,id'
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $experience = Experience::firstOrCreate([
            'user_id' => Auth()->id(),
            'game_id' => $request->game_id
        ]);

        $experience->increment('total', $request->experience);
        $experience->experienceTransactions()->create([
            'total' => $request->experience
        ]);

        $coins = Experience::with(['ExperienceTransactions'])->whereUserId($user->id)->get()->makeHidden(['user_id', 'id', 'created_at']);
        $data = collect([
            'experience' => $coins
        ]);
        return $this->success($data);
    }
}

