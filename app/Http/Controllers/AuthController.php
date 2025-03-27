<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Mail\Mailable;
// use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\JobController;
use App\Http\Requests\User\CreateUserRequest;
//use App\Jobs\SendEmailJob as JobsSendEmailJob;
use App\Jobs\SendEmailJob;
use App\Http\Controllers\response;

class AuthController extends Controller
{
      // Register a new user
      public function register(CreateUserRequest $request)
      {
         
        // dd($request->all());
        $data= $request->validated();
        $data["password"] = Hash::make($request->password);
  
          // Create the user
          $user = User::create($data);
  
          // Generate JWT otp
          $otp = JWTAuth::fromUser($user);
        

          return new UserResource($user ,$otp);
      }
  
      // Login a user
      public function login(Request $request)
      {
          // Validate the incoming request
          $credentials = $request->only('email', 'password');
  

          if (!$otp = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'Unauthorized'], 401);
          }

          $user = User::where("email" , $request->email)->first();
  
          return new UserResource($user ,$otp);
      }
  
      // Logout the user
      public function logout(Request $request)
      {
        //   JWTAuth::invalidate(JWTAuth::getotp());
          JWTAuth::invalidate(JWTAuth::getToken());
  
          return response()->json(['message' => 'Successfully logged out']);
      }


      /** 17/2/2025
     * Handle Forgot Password Request
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->firstOrFail();

        $otp = rand(100000, 999999);
        $user->otp=$otp;
        // Store in Password Resets Table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['otp' => $otp, 'created_at' => now()]
        );

        // dd($user->email,$otp);
        //dispatch(new jobController('marojojo707@gmail.com'));
        dispatch(new SendEmailJob($user->email,$otp));


        // Send Email
        // Mail::to($user->email)->send(new ResetPasswordMail($otp, $user->email));
        // Mail::to($user->email)->send(new SendEmailJob($user->email, $otp));
        return response()->json(['message' => 'Password reset link sent!'], 200);
    }

    /**
     * Handle Reset Password Request
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $resetData = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();

        if (!$resetData) {
            return response()->json(['message' => 'Invalid otp'], 400);
        }

        // Update User Password
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete otp
        DB::table('password_resets')->where('email', $request->email)->delete();

       

        return response()->json(['message' => 'Password reset successful!'], 200);
    }
}
