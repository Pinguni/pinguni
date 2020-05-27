<?php

namespace App;

use Blade;
use App\Icon;
use App\UsersCardsProgress;

class Help 
{
    /**
     *  Convert tags to array
     *  @param array
     *  @return array
     */
    public static function tags($oldTags) 
    {
        $exTags = explode(",", $oldTags);  // split tags by comma
        $tags = null;  
        
        foreach ($exTags as $tag) {  // trim tags
            $tag = trim($tag);
            $tags[] = $tag;
        }
        
        sort($tags);  // sort tags in alphabetical order
        
        return $tags;
    }
    
    
    /**
     *  Format card url
     *  @param Card object
     *  @return string
     */
    public static function cardUrl($card) 
    {        
        $url = '/';
        
        if ($card->type == 'resource')
        {
            $title = str_replace(' ', '-', strtolower($card->title));
            $url = "/resources/search/$title";
        }
        else if ($card->type == 'course')
        {
            $url = "/resources/courses/$card->permalink";
        }
        else
        {
            $url = "/resources/view/$card->type" . "s/$card->permalink";
        }
        
        return $url;
    }
    
    public static function cardWidth($width)
    {
        $wid = null;
        
        switch($width)
        {
            /* case "full":
                $wid = "md:w-1/2 lg:w-1/3";
                break;
            case "article":
                $wid = "lg:w-1/2 xl:w-1/3";
                break; */
            case "horizontal":
                $wid = "horizontal";
                break;
        }
        return $wid;
    }
    
    
    /**
     *  Format card url
     *  @param string
     *  @return string
     */
    public static function unKebab($string) 
    {
        
        $string = str_replace('-', ' ', $string);
        
        return $string;
    }
    
    
    public static function notes($notes)
    {
        if ($notes)
        {
            $notes = json_decode($notes);
        }
        
        if (isset($notes->content))
        {
            $content = Blade::compileString($notes->content);
            return $content;
        } else {
            return null;
        }
    }
    
    
    public static function userCardStatus($user_id, $card_id)
    {
        $progress = UsersCardsProgress::where('user_id', $user_id)
                                      ->where('card_id', $card_id)
                                      ->first();
        if (isset($progress))
        {
            return $progress->status;
        }
        else {
            return null;
        }
    }
}
