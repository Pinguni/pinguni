<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{   
    public function index()
    {
        $cacheKey = 'homepage.cards';

        $cards = Cache::remember($cacheKey, now()->addHours(24 * 7), function() {
            $cards = Card::where('tags', 'LIKE', '%homepage%')
                          ->get();
            return $cards;
        });
        
        return view('index', [
            'cards' => $cards,
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
