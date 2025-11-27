<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'anticipated',
        'explanation',
        'amount',
        'date_of_change',
    ];

    /**
     * Relación con el modelo Client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
