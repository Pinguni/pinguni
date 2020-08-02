<?php

namespace App\Http\Controllers;

use Auth;
use App\UserNote;
use Illuminate\Http\Request;

class UserNoteController extends Controller
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
            'note' => 'required',
        ]);
        
        $note = new UserNote;
        $note->user_id = Auth::id();
        $note->note = $request->note;
        return $note->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserNotes  $userNotes
     * @return \Illuminate\Http\Response
     */
    public function show(UserNotes $userNotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserNotes  $userNotes
     * @return \Illuminate\Http\Response
     */
    public function edit(UserNotes $userNotes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserNotes  $userNotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserNotes $userNotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserNotes  $userNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserNotes $userNotes)
    {
        //
    }
}
