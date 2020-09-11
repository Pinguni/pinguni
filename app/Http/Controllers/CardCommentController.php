<?php

namespace App\Http\Controllers;

use Auth;
use App\CardComment;
use Illuminate\Http\Request;

class CardCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'card_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required',
        ]);

        $comment = new CardComment;
        $comment->card_id = $request->card_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        return $comment->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardComment  $cardComment
     * @return \Illuminate\Http\Response
     */
    public function show(CardComment $cardComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardComment  $cardComment
     * @return \Illuminate\Http\Response
     */
    public function edit(CardComment $cardComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardComment  $cardComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardComment $cardComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardComment  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) 
        {
            $comment = CardComment::find($id);
            if (Auth::user()->role == 'admin' || Auth::id() == $comment->user_id) {
                return $comment->delete();
            }
        }
    }
}
