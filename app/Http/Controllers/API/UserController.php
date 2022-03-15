<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use ApiResponse;

    public function show(Request $request)
    {
        $user = JWTAuth::authenticate($request->bearerToken());
        if (!$user) return $this->error(401, 'Authorization Token not found');
        $data = $user;
        $data['avatar'] = $user->getAvatar();
        unset($data['media']);
        return $this->success($data, "Welcome " . $user->name);
    }
}
