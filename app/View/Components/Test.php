<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Test extends Component
{
    /**
     * The hero title.
     *
     * @var string
     */
    //public $h1;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()//$hey)
    {
        //$this->hey = $hey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.test');
    }
}
