<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'bank_name',
        'bank_address',
        'city',
        'city_state_zip',
        'property_security',
        'account_number',
        'credit_limit',
        'loan_balance',
        'employed_years',
        'minimum_monthly_payment',
        'statement_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
