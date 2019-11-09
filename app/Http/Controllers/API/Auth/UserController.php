<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Contractor;
use App\Code;
use AfricasTalking\SDK\AfricasTalking;

class UserController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [id] contractor_id
     * @param  [id] team_id
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['phone']);
        $user = User::create($input);
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function loginWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ], 200);
    }

    public function loginMobile(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);

        //check if user exists
        if (!Auth::attempt($credentials))
            return response()->json(['message' => ['status' => 'failure', 'displayMessage' => 'Wrong email or password']], 401);
        //if user exists and the password matches the email, send an authentication code via text
        $user = $request->user();
        $phone = $user->phone;
        $message = rand(100000, 900000);


        $username = env('AT_USERNAME'); // use 'sandbox' for development in the test environment
        $apiKey = env('AT_SECRET_KEY'); // use your sandbox app API key for development in the test environment
        $AT = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms = $AT->sms();

        // Use the service
        $result = $sms->send([
            'to' => $phone,
            'message' => $message
        ]);
        //save the message in the db

        if ($result['status'] == "success") {
            $user_id = $user->id;
            Code::create(['user_id' => $user_id, 'code' => $message]);
            return response()->json(['message' => ['status' => $result['status'], 'data' => $user]], 200);
        }


    }

    public function generateToken(Request $request)
    {
        $user = User::where('id', '=', 1)->first();
        $code = Code::where('user_id', '=', 1)->first();
        if ($request->get('code') == $code->code) {

            $tokenResult = $user->createToken('Personal Access Token');

            //delete authentication code after successful login
            Code::find($code->id)->delete();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ], 200);
        } else {
            return response()->json(['message' => ['status' => 'failure', 'displayMessage' => 'something went wrong']], 400);
        }
    }

    public function updatePassword(Request $request)
    {
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->password_change_at = true;
        if ($user->save()) {
            return response()->json(['message' => $user], 200);
        }

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    public function test(Request $request)
    {
        $input = $request->all();

        $con = Contractor::create($input);

        return response()->json(['message ' => $con], 201);
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
}
