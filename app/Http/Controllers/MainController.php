<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class MainController extends Controller
{   
    public function index()
    {
        $resCard = Card::find(14);
        $jouCard = Card::find(78);
        
        return view('index', [
            'resCard' => $resCard,
            'jouCard' => $jouCard,
        ]);
    }
    
    /**
     * Show the search page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search($word = null)
    {
        $details = null;
        
        $cards = Card::ofVisibility('public')  // make sure it's public
                       ->where('tags', 'LIKE', "%searchable%")  // make sure it's searchable
                       ->where('tags', 'LIKE', "%$word%")
                       ->orderBy('created_at', 'DESC')
                       ->paginate(5);
        
        $cap = ucfirst($word) . 's';  // Capitalize and pluralize
        
        return view('search', [
            'cards' => $cards,
            'word' => $word,
            'details' => $details,
        ]);
    }
}
