<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'contents',
        'value',
    ];

    /**
     * Relación con el modelo Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
