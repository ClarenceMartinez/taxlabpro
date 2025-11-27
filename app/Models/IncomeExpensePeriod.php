<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpensePeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'account_method',
        'from_date',
        'to_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
