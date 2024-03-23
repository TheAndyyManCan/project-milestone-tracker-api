<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return UserResource::collection(User::all());
    }

    public function store(RegisterUserRequest $request){
        $user = User::create($request->validated());
        return UserResource::make($user);
    }

    public function login(LoginRequest $request){
        if(Auth::attempt($request->validated())){
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User could not be authenticated'
            ], 401);
        }
    }

}
