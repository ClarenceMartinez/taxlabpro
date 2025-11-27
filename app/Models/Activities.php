<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    //
    protected $table = 'activities';

    protected $fillable=[
            'deal',
            'title',
            'type',
            'notes',
            'date',
            'time',
            'duration',
            'client_id',
            'user_id'
    ];
}
