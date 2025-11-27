<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'company_name',
        'company_address',
        'city_state_zip',
        'policy_number',
        'policy_owner',
        'current_cash_value',
        'outstanding_loan_balance',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
