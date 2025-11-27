<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'description',
        'email',
        'asset_name',
        'account_number',
        'units',
        'digital_address',
        'location',
        'current_value',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
