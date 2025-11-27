<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'card_type',
        'name_on_account',
        'merchant_account_number',
        'issuing_bank',
        'street_address',
        'city_state_zip',
        'phone',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
