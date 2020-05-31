<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'icon' => 'max:255',
            'thumbnail' => 'max:255',
            'bg' => 'max:255',
            'title' => 'required|max:100',
            'description' => 'required|max:150',
            'type' => 'required|max:15',
            'visibility' => 'required|max:15',
            'permalink' => 'required|max:150'
        ]);
        
        $card = Card::find($id);
        $card->icon = $request->icon;
        $card->thumbnail = $request->thumbnail;
        $card->bg = $request->bg;
        $card->title = $request->title;
        $card->description = $request->description;
        $card->notes = $request->notes;
        $card->tags = $request->tags;
        $card->type = $request->type;
        $card->visibility = $request->visibility;
        $card->permalink = $request->permalink;
        $card->save();
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
