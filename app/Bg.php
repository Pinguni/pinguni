<?php

namespace App;

use App\SVG;

class Bg
{   
    /**
     *  backgrounds by SVGBackgrounds.com
     */
    
    public static function get($bg)
    {
        if (strpos($bg, 'http') !== false)
        {
            return $bg;
        }
        else {
            $svg = '';

            switch($bg)
            {
                case 'abstract_envelope':
                    $svg = SVG::$abstract_envelope;
                    break;
                case 'alternating_arrowhead':
                    $svg = SVG::$alternating_arrowhead;
                    break;
                case 'pattern_randomized_indigo':
                    $svg = SVG::$pattern_randomized_indigo;
                    break;
                case 'subtle_prism_indigo':
                    $svg = SVG::$subtle_prism_indigo;
                    break;
                case 'wintery_sunburst':
                    $svg = SVG::$wintery_sunburst;
                    break;
                case 'wintery_sunburst_green':
                    $svg = SVG::$wintery_sunburst_green;
                    break;
                default:
                    $svg = SVG::$alternating_arrowhead;
                    break;
            }

            return $svg;
        }
    }
}