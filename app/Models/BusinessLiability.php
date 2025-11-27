<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLiability extends Model
{
    use HasFactory;

    protected $table = 'business_liabilities'; // opcional si sigues la convención

    protected $fillable = [
        'client_id',
        'description',
        'name',
        'street',
        'city_state_zip',
        'phone',
        'date_pledged',
        'balance_owed',
        'payment_amount',
        'final_payment',
        'collateral',
    ];

    /**
     * Relación con el modelo Client (Muchos a Uno)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
