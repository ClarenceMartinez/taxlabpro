<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntangibleAsset extends Model
{
    use HasFactory;

    protected $table = 'intangible_assets'; // opcional si sigues la convención

    protected $fillable = [
        'client_id',
        'description',
        'purchase_date',
        'current_value',
    ];

    /**
     * Relación con el modelo Client (Muchos a Uno)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
