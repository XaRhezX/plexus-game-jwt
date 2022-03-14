<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    use ApiResponse;

    public function handle(Request $request)
    {
        try {
            JWTAuth::invalidate($request->bearerToken());
            return $this->success('User logged out successfully', 200);
        } catch (JWTException $exception) {
            return $this->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'Sorry, the user cannot be logged out');
        }
    }
}
