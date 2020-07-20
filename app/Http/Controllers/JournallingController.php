<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ramble;
use App\RamblePrompt;

class JournallingController extends Controller
{
    /**
     * Show the main journalling page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prompts = RamblePrompt::ofVisibility('public')->orderBy('created_at', 'DESC')->get();
        
        if (!Auth::guest())
        {
            $answers = Ramble::where('user', Auth::id())->orderBy('created_at', 'DESC')->get();
            
            return view('journalling.index', [
                'prompts' => $prompts,
                'answers' => $answers,
            ]);
        }
        
        return view('journalling.index', [
            'prompts' => $prompts,
        ]);
    }
}
