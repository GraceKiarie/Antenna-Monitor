<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    public function showMyProfile($user_id)
    {
        $myDetails = DB::table('users')->where('id', '=', $user_id)->get();
        return view('auth.my_profile' ,compact('myDetails'));
    }

    public function showUserProfile($user_id)
    {
        $userDetails = DB::table('users')->where('id', '=', $user_id)->get();
        return view('auth.user_profile' ,compact('userDetails'));
    }

    public function updateUserDetails(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if ($request->isMethod('post')) {
            if ($request->filled('name')) {
                $request->validate([
                    'name' => [
                        'required', 
                        'string', 
                        'max:255'
                    ],
                ]);
                $user->name = $request->input('name');
            }
            if ($request->filled('email')) {
                $request->validate([
                    'email' => [
                        'required',
                        'max:15',
                        Rule::unique('users')->ignore($user->id),
                    ],
                ]);
                $user->email = $request->input('email');
            }
            if ($request->filled('phone')) {
                $request->validate([
                    'phone' => [
                        'required',
                        'unique:users',
                        'max:5', 
                        Rule::unique('users')->ignore($user->id),
                    ],
                ]);
                $user->phone = $request->input('phone');
            }
            $user->save();
        }
        return redirect('/users');
    }
}
