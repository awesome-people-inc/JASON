<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'headline', 'location', 'avatar', 'facebook_id', 'github_id', 'google_id', 'twitter_id', 'facebook_url', 'github_url', 'google_url', 'twitter_url', 'github_nickname', 'linkedin_id', 'linkedin_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
