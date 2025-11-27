<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    /**
    * Database table name
    */
    protected $table = 'user_to_client';
    protected $primaryKey = 'id';

    /**
    * Mass assignable columns
    */
    protected $fillable=
        [
        	'client_id',
        	'user_id'
        ];

    /**
    * Date time columns.
    */
    protected $dates=[];

    public function user()
    {
        return $this->belongsTo(User::class);  // Esto define la relación 'user' en UserClient
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
