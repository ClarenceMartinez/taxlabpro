<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'street_address',
        'city_state_zip',
        'country',
        'description',
        'title_held',
        'purchase_date',
        'purchase_price',
        'refinance_date',
        'refinance_amount',
        'current_value',
        'loan_balance',
        'monthly_payment',
        'final_payment_date',
        'lender_name',
        'lender_address',
        'lender_city_state_zip',
        'lender_phone'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
