<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankruptcy extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date_field',
        'petition_no',
        'location',
        'date',
        'extra_field'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
