<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class DashController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::guest())
        {
            // Get user's cards progress
            $cards = User::find(Auth::id())->cardsProgress()->where('cards.type', 'course')->get();  
            
            return view('dash.index', [
                'cards' => $cards,
            ]);
        }
        else {
            return $redirect()->back();
        }
    }
}
