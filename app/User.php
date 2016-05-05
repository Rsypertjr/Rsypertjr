<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Contact;

class User extends Authenticatable
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];
    
    
     /**
     * Get all of the tasks for the user.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
     /**
     * Get all of the SocialAccounts for the user.
     */
    public function socialaccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
    
  
  
}
