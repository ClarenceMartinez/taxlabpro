<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'primary_vehicle_for',
        'year',
        'make',
        'model',
        'vin',
        'mileage',
        'license',
        'purchase_date',
        'current_value',
        'current_loan_balance',
        'monthly_payment',
        'date_of_final_payment',
        'lender_name',
        'lender_address',
        'lender_city_state_zip',
        'lender_phone',
        'is_loan',
        'is_lease',
        'type'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
