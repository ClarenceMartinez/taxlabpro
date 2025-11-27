<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyIntangibleAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'description',
        'current_value',
        'purchase_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
