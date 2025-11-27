<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetirementAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'account_type',
        'account_number',
        'company_name',
        'address',
        'city_state_zip',
        'company_phone',
        'current_value',
        'loan_balance',
        'statement_date',
        'used_as_collateral',
        'custom_quick_sale',
        'fed_tax_rate',
        'fed_penalty',
        'state_tax_rate',
        'state_penalty',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
