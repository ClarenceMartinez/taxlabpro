<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyToolEquipment extends Model
{
    use HasFactory;

    protected $table = 'company_tools_equipment';

    protected $fillable = [
        'client_id',
        'description',
        'street_address',
        'city_state_zip',
        'current_value',
        'current_loan_balance',
        'purchase_date',
        'date_of_final_payment',
        'status',
        'monthly_payment',
        'lender',
        'lender_address',
        'lender_phone',
        'is_leased_or_income_generating',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
