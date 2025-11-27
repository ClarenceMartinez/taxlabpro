<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBankAccount extends Model
{
    use HasFactory;

    protected $table = 'company_bank_accounts';

    protected $fillable = [
        'client_id',
        'account_type',
        'bank_name',
        'bank_address',
        'city_state_zip',
        'account_number',
        'current_value',
        'statement_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
