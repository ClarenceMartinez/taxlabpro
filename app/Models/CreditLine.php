<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditLine extends Model
{
    use HasFactory;

    protected $table = 'credit_lines'; // opcional si sigues la convención

    protected $fillable = [
        'client_id',
        'bank_name',
        'account_number',
        'bank_address',
        'city_state_zip',
        'property_security',
        'credit_limit',
        'loan_balance',
        'minimum_monthly_pmt',
        'statement_date',
    ];

    /**
     * Relación con el modelo Client (Muchos a Uno)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
