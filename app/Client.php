<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'client_group',
        'notes'
    ];
    
    protected $guarded = [];
}
