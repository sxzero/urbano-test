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

    protected $hidden = ['notes'];
    
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'client_group_id',
        'notes'
    ];
    
    protected $guarded = [];


    /**
     * Get the Client Group that owns the client
     */
    public function client_group()
    {
        return $this->belongsTo('App\ClientGroup');
    }
}
