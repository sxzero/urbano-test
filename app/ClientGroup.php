<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];
    
    protected $guarded = [];

    /**
     * Get the Clients.
     */
    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
