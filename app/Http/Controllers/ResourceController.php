<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Help;

class ResourceController extends Controller
{
    /**
     * Show the main resources page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $collections = Card::where('type', 'main')->get();
        
        return view('resources.index', [
            'collections' => $collections,
        ]);
    }
    
    
    /**
     * Show the view page for pockets / snippets / links etc.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($type, $permalink)
    {
        $card = Card::ofVisibility('public')->where('permalink', $permalink)->first();
        
        if (!isset($card) || ($card->type != $type))  // if card does not exist, redirect to home page
        {
            return redirect()->home();
        }
        
        if ($card->type == 'link')  // if card is link
        {
            return view('resources.link', [
                'card' => $card,
            ]);
        }
        else  // if card is not a link but exists
        {
            return view('resources.page', [
                'card' => $card,
            ]);
        }
    }
    
    
    /**
     * Return main guide page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guide($guide)
    {   
        $gui = Card::ofVisibility('public')->where('permalink', $guide)->first();
        
        $role = null;
        if (!Auth::guest())
            $role = Auth::user()->role;
        
        return view('resources.guides.index', [
            'gui' => $gui,
            'role' => $role,
        ]);
    }
    
    
    /**
     * Return guide pocket page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guidePocket($guide, $pocket)
    {
        $gui = Card::ofVisibility('public')->where('permalink', $guide)->first();
        $poc = Card::ofVisibility('public')->where('permalink', $pocket)->first();
        
        return view('resources.guides.pocket', [
            'gui' => $gui,
            'poc' => $poc,
        ]);
    }
    
    
    /**
     * Return guide page page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guidePage($guide, $pocket, $page)
    {
        $gui = Card::ofVisibility('public')->where('permalink', $guide)->first();
        $poc = Card::ofVisibility('public')->where('permalink', $pocket)->first();
        $pag = Card::ofVisibility('public')->where('permalink', $page)->first();
        
        $role = null;
        if (!Auth::guest())
            $role = Auth::user()->role;
        
        return view('resources.guides.page', [
            'gui' => $gui,
            'poc' => $poc,
            'pag' => $pag,
            'role' => $role,
        ]);
    }
    
    
    /**
     * Return cards for search page AJAX
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cards(Request $request, $tags)
    {
        $tags = explode(',', $tags);  // Separate tags by comma
        
        $cards = Card::query();  // Prepare cards query
        
        $cards = $cards->where('tags', 'LIKE', "%searchable%");  // Make sure cards as searchable
        
        foreach($tags as $tag)
        {
            $tag = trim($tag);  // Trim whitespace from tags
            
            if (strpos($tag, '!'))
            {
                $tag = ltrim($tag, '!');
                $cards = $cards->where('tags', 'NOT LIKE', "%$tag%");  // Build query
            }
            else {
                $cards = $cards->where('tags', 'LIKE', "%$tag%");  // Build query
            }
        }

        $cards = $cards->ofVisibility('public')
                       ->orderBy('created_at', 'DESC')
                       ->paginate(5); 
        
        return view('resources.get.cards', [
            'cards' => $cards,
        ]);
    }
}
