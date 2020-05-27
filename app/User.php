<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'tagline', 'bio', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get signed url for user's profile photo.
     *
     * @return string
     */
    public static function getPFP()
    {        
        $url = '';
        
        if (Auth::user()->pfp != '')
        {
            $url = Auth::user()->pfp;
            
            /* $s3 = S3::client();
            
            $obj = $s3->getCommand('GetObject', [
                'Bucket' => 'masahachaim',
                'Key' => Auth::user()->pfp,
            ]);

            $request = $s3->createPresignedRequest($obj, '+20 minutes');

            $url = (string)$request->getUri(); */
        }
        else
        {
            $url = 'https://cdn.pixabay.com/photo/2016/04/22/04/57/graduation-1345143_1280.png';
        }
        
        return $url;
    }
    
    /**
     * Get cards user has saved
     *
     * @return Eloquent
     */
    public static function cardsSaved()
    {
        return $this->belongsToMany('App\Card', 'users_and_cards', 'user_id', 'card_id');
    }
    
    /**
     * Get the cards the user is working on
     *
     * @return Eloquent
     */
    public function cardsProgress()
    {
        return $this->belongsToMany('App\Card', 'users_cards_progress', 'user_id', 'card_id');
    }
}
