<?php

namespace App;

class Icon 
{
    public static function get($shorthand) 
    {   
        if(strpos($shorthand, 'http') !== false) 
        {
            return "<img draggable='false' class='emoji' src='$shorthand'>";
        }
        else {
            return '<img draggable="false" class="emoji" alt="' . $shorthand 
                . '" src="/flaticon/' . $shorthand . '.svg">';
        }
        
    }
}