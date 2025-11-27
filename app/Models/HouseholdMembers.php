<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseholdMembers extends Model
{
    //
    protected $table = 'household_members';

    protected $fillable=[
    	'client_id',
    	'name',
    	'age',
    	'relationship'
    ];
}
