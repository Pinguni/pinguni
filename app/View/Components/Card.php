<?php

namespace App\View\Components;

use App\Bg;
use App\Help;
use Illuminate\View\Component;

class Card extends Component
{   
    /**
     * The card object.
     *
     * @var object
     */
    public $card;
    
    /**
     * Width of card.
     *
     * @var string
     */
    public $width;
    
    /**
     * Height of card.
     *
     * @var string
     */
    public $height;
    
    /**
     * Defines whether or not card type is hidden.
     *
     * @var string
     */
    public $hideType;

    /**
     * Create the component instance.
     *
     * @param  object  $card
     * @return void
     */
    public function __construct($card, $width, $height, $hideType = '')
    {
        $this->card = json_decode($card);
        
        $this->width = $width;
        $this->height = $height;
        $this->hideType = $hideType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
