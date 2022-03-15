<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use ApiResponse;
    public $token = true;

    public function handle(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        if ($this->token) {
            return (new LoginController)->handle($request);
        }
        $data = $user;
        $data['avatar'] = $user->getAvatar();
        unset($data['media']);
        return $this->success($data);
    }
}
