<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryInsurance extends Model
{
    use HasFactory;
    protected $table = 'beneficiaries_insurance';

    protected $fillable = [
        'client_id',
        'trust_or_policy_name',
        'place_recorded',
        'ein',
        'anticipated_amount',
        'amount_receival_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

