<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedPartyOweBusiness extends Model
{
    use HasFactory;

    protected $table = 'related_parties_owe_business';

    protected $fillable = [
        'client_id',
        'name',
        'address',
        'city_state_zip',
        'date_of_loan',
        'current_balance',
        'as_of',
        'payment_date',
        'payment_amount',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
