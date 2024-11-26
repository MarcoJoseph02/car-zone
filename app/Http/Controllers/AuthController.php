<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
      // Register a new user
      public function register(CreateUserRequest $request)
      {
         
        $data= $request->validated();
        $data["password"] = Hash::make($request->password);
  
          // Create the user
          $user = User::create($data);
  
          // Generate JWT token
          $token = JWTAuth::fromUser($user);
  
          return new UserResource($user ,$token);
      }
  
      // Login a user
      public function login(Request $request)
      {
          // Validate the incoming request
          $credentials = $request->only('email', 'password');
  

          if (!$token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'Unauthorized'], 401);
          }

          $user = User::where("email" , $request->email)->first();
  
          return new UserResource($user ,$token);
      }
  
      // Logout the user
      public function logout()
      {
          JWTAuth::invalidate(JWTAuth::getToken());
  
          return response()->json(['message' => 'Successfully logged out']);
      }
}
