<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',
        'description',
        'street_address',
        'city_state_zip',
        'county',
        'purchase_date',
        'current_value',
        'current_loan_balance',
        'monthly_payment',
        'date_of_final_payment',
        'lender',
        'lender_address',
        'lender_city_state_zip',
        'lender_phone',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
