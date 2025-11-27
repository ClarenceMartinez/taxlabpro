<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;
    protected $table = 'employment';
    protected $fillable = [
        'client_id',
        'employer',
        'street',
        'city',
        'state',
        'zip_code',
        'work_phone',
        'contact_at_work_allowed',
        'occupation',
        'business_interest',
        'employed_status',
        'pay_period',
        'gross_wage',
        'federal_tax',
        'state_tax',
        'local_tax',
        'does_not_withhold_social_security',
        'does_not_withhold_medicare'
    ];
    public function payPeriod() {
        return $this->belongsTo(PayPeriod::class, 'pay_period', 'id');
    }
}
