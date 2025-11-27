<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProcessor extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'processor_name',
        'street_address',
        'city_state_zip',
        'account_number',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
