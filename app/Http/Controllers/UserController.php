<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show a user's profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile($username)
    {
        $user = User::where('username', $username)->first();
        
        return view('users.profile', [
            'user' => $user,
        ]);
    }
}
