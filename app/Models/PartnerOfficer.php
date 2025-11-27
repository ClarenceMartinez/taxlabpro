<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerOfficer extends Model
{
    use HasFactory;

    protected $table = 'partners_officers';

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'title',
        'street_address',
        'city',
        'state',
        'zip_code',
        'phone1',
        'phone2',
        'social_security_number',
        'ownership_percentage',
        'shares_interest',
        'annual_salary_draw',
        'responsible_for_depositing_payroll_taxes',
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
