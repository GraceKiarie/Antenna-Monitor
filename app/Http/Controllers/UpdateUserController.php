<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateUserController extends Controller
{
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUserProfile($user_id)
    {
        $userDetails = DB::table('users')->where('id', '=', $user_id)->get();
        return view('auth.user_profile' ,compact('userDetails'));
    }

    public function updateUserDetails(Request $request)
    {
        $user = User::find($request->input('id'));
        if ($request->isMethod('post')) {
            if ($request->filled('name')) {
                Validator::make($request->all(), [
                    'name' => 'string|max:255',
                ]);
                $user->name = $request->input('name');
            }
            if ($request->filled('email')) {
                Validator::make($request->all(), [
                    'email' => 'string|email|max:255',
                ]);
                $user->email = $request->input('email');
            }
            if ($request->filled('phone')) {
                Validator::make($request->all(), [
                    'name' => 'string|max:255',
                ]);
                $user->phone = $request->input('phone');
            }
            $user->save();
        }
    }

    protected function validate(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['phone'])
        ]);
    }

    
}
