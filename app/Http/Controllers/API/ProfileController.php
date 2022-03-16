<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    use ApiResponse;

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, $validator->errors());
        }


        if ($files = $request->file('image')) {

            $user = JWTAuth::user();
            $user
            ->addMedia($files)
            ->preservingOriginal()
            ->toMediaCollection();

            return $this->success($user->getMEdia()->last()->original_url, "File successfully uploaded");
        }
    }
}
