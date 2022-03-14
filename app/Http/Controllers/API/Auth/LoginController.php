<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use ApiResponse;

    public function handle(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return $this->error(Response::HTTP_UNAUTHORIZED, 'Invalid Email or Password');
        }
        $user = JWTAuth::user();
        $data = collect([
            'token' => $jwt_token
        ]);
        return $this->success($data, "Welcome, " . $user->name);
    }
}
