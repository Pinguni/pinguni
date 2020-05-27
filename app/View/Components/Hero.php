<?php

namespace App\View\Components;

use App\Bg;
use Illuminate\View\Component;

class Hero extends Component
{   
    /**
     * The hero background image.
     *
     * @var string
     */
    public $bg;

    /**
     * Create the component instance.
     *
     * @param  string  $bg
     * @return void
     */
    public function __construct($bg)
    {
        /**
         *  <if> card background is null,
         *  use default bacground <var> envelope
         */
        $bgHolder = '';
        if ($bg == null) {
            $bgHolder = Bg::get('default');
        }
        else {
            $bgHolder = Bg::get($bg);
        }
        $this->bg = $bgHolder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.hero');
    }
}
