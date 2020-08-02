<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserNote;
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
            $cards = User::find(Auth::id())
                           ->cardsProgress()
                           ->where('cards.type', 'guide')
                           ->orderBy('created_at', 'DESC')
                           ->get(); 
            
            // Get user notes
            $notes = UserNote::where('user_id', Auth::id())
                               ->orderBy('created_at', 'DESC')
                               ->get();
            
            return view('dash.index', [
                'cards' => $cards,
                'notes' => $notes,
            ]);
        }
        else {
            return $redirect()->back();
        }
    }
}
