<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
    	'client_id',
        'business_name',
        'business_address',
        'city_state_zip',
        'phone',
        'type_of_business',
        'ownership_percentage',
        'title',
        'ein',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
