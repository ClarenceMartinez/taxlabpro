<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    protected $table = 'notes';

    protected $fillable=[
		'description',
		'client_id',
		'user_id',
		'event_date'
    ];
}
