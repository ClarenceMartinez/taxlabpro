<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type_of_account',
        'bank_name',
        'address',
        'city_state_zip',
        'account_number',
        'current_value',
        'statement_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function BankAccountType()
    {
        return $this->belongsTo(BankAccountType::class);
    }
}
