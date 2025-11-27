<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeDepositBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'location_name',
        'location_address',
        'city_state_zip',
        'box_numbers',
        'contents',
        'value',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
