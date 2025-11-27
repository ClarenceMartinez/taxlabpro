<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAffiliation extends Model
{
    use HasFactory;

    protected $table = 'business_affiliations';

    protected $fillable = [
        'client_id',
        'business_name',
        'street_address',
        'city_state_zip',
        'ein',
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
