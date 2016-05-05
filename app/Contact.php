<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   /**
    * The attributes that are mass assignable
    * 
    * @var array
    */
    protected $fillable = ['firstname','lastname','email','phone','extraDetail1','extraDetail2','extraDetail3','extraDetail4','extraDetail5','noExtraDetails'];
    
    /**
     * Get the user that owns the task
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
