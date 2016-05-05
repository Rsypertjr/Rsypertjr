<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'facebook_provider_user_id','github_provider_user_id', 'facebook','github'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
