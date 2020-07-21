<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Card;
use App\Help;
use App\CardsAndCards;

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
    public function view($type, $id, $permalink)
    {
        $card = Card::ofVisibility('public')->where('id', $id)->first();
        
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
        elseif ($card->type == 'pocket')  // if card is a pocket           | TODO:  Add routes for standalone pockets
        {
            $guideH = CardsAndCards::where('child_id', $id)->first();
            $guide = Card::find($guideH->parent_id);
            return $this::guidePocket($guide->permalink, $card->id, $card->permalink);
        }
        elseif ($card->type == 'page')  // if card is a page
        {
            $pocketH = CardsAndCards::where('child_id', $id)->first();
            $pocket = Card::find($pocketH->parent_id);
            $guide = Card::find(CardsAndCards::where('child_id', $pocket->id)->first()->parent_id);
            return $this::guidePage($guide->permalink, $pocket->id, $pocket->permalink, $card->id, $card->permalink);
        }
        else  // if card is not a link but exists
        {
            $role = null;
            if (!Auth::guest())
                $role = Auth::user()->role;
            
            return view('resources.page', [
                'card' => $card,
                'role' => $role,
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
        $gui = Card::ofVisibility('public')->where('type', 'guide')->where('permalink', $guide)->first();
        
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
    public function guidePocket($guide, $id, $pocket)
    {
        $gui = Card::ofVisibility('public')->where('type', 'guide')->where('permalink', $guide)->first();
        $poc = Card::ofVisibility('public')->where('id', $id)->first();
        
        $role = null;
        if (!Auth::guest())
            $role = Auth::user()->role;
        
        return view('resources.guides.pocket', [
            'gui' => $gui,
            'poc' => $poc,
            'role' => $role,
        ]);
    }
    
    
    /**
     * Return guide page page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guidePage($guide, $pocId, $pocket, $pagId, $page)
    {
        $gui = Card::ofVisibility('public')->where('type', 'guide')->where('permalink', $guide)->first();
        $poc = Card::ofVisibility('public')->where('id', $pocId)->first();
        $pag = Card::ofVisibility('public')->where('id', $pagId)->first();
        
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
