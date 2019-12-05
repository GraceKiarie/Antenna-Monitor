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
use App\Role;
use GuzzleHttp;
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
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    public function sendMessage($phone, $message)
    {
        $username = env('AT_USERNAME');
        $apiKey = env('AT_SECRET_KEY');
        $AT = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms = $AT->sms();

        // Use the service
        $result = $sms->send([
            'to' => $phone,
            'message' => $message
        ]);

        return $result;
    }

    public function login(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);

        //check if user exists
        if (!Auth::attempt($credentials)){
            return response()->json(['status' => 'failure', 'data' => ['message' => 'Wrong email or password']], 401);


        }

        $http = new GuzzleHttp\Client;

        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 6,
                'client_secret' => 'edPZRwBlm8p4l4FNcrW8w44E22ZYxD6jdLxtg9yX',
                'username' => $request->get('email'),
                'password' => $request->get('password'),
                'scope' => '',
            ],
        ]);

        return $response->getBody();
    }

    public function generateToken($id, Request $request)
    {
        $user = User::with('role')->where('id', '=', $id)->first();


        $code = Code::where('user_id', '=', $id)->first();
        if ($request->get('code') == $code->code) {

            $tokenResult = $user->createToken('Personal Access Token');

            //delete authentication code after successful login
            Code::find($code->id)->delete();
            return response()->json([
                'status' => 'success',
                'access_token' => $tokenResult->accessToken,
                'role' => $user->role->role_name,
                'type' => 'Bearer'
            ], 200);
        } else {
            return response()->json(['status' => 'failure', 'data' => ['message' => 'wrong code']], 400);
        }
    }

    public function updatePassword(Request $request)
    {
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->password_change_at = true;
        if ($user->save()) {
            return response()->json(['status' => 'success', 'data' => $user], 200);
        } else {
            return response()->json(['status' => 'failure', 'data' => ['message' => 'password update failed']], 404);
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

    /**
     * forgot password
     * @params - phone
     */
    public function forgotPassword(Request $request)
    {

        //validate input
        $request->validate([
            'phone' => 'required',
        ]);
        $phone = $request->get('phone');
        $generatedCode = rand(200000, 999999);
        $message = "Your new password is  " . $generatedCode;
        $user = User::where('phone', $phone)->first();
        //dd($user);

        if ($user) {
            $user->password = Hash::make($generatedCode);
            $user->password_change_at = false;
            $user->save();

            $result = $this->sendMessage($phone, $message);
            return response()->json(['status' => $result['status'], 'data' => 'Password sent'], 200);

        } else {
            return response()->json(['status' => 'Failure', 'data' => 'Phone number does not exist'], 404);
        }

    }

}
