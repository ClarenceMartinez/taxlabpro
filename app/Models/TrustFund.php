<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustFund extends Model
{
    use HasFactory;
    protected $table = 'trust_funds';

    protected $fillable = [
        'client_id',
        'amount',
        'location',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
