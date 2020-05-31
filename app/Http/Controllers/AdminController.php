<?php

namespace App\Http\Controllers;

use Auth;
use App\Card;

class AdminController extends Controller
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
        return view('admin.index');
    }
    
    
    /**
     * Show the create card form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createCard()
    {
        return view('admin.create.card');
    }
    
    
    /**
     * Show the edit card form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editCard($id)
    {
        $card = Card::find($id);
        
        return view('admin.edit.card', [
            'card' => $card,
        ]);
    }
}
