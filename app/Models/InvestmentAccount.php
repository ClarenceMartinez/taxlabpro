<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type_of_account',
        'company_name',
        'address',
        'city_state_zip',
        'account_number',
        'company_phone',
        'current_value',
        'loan_balance',
        'statement_date',
        'used_as_collateral'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
