<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateUserController extends Controller
{
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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


    public function updateUserDetails($id ,Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->save();

        return back();
    }
}
