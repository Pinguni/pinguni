<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comments extends Component
{   
    /**
     * The comment object.
     *
     * @var object
     */
    public $comments;

    /**
     * The card id.
     *
     * @var object
     */
    public $cardId;

    /**
     * Create the component instance.
     *
     * @param  object  $comments
     * @return void
     */
    public function __construct($comments, $cardId)
    {
        $this->comments = json_decode($comments);
        $this->cardId = $cardId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.comments');
    }
}
