<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignProperty extends Model
{
    use HasFactory;

    protected $table = 'foreign_properties'; // opcional si sigues la convención

    protected $fillable = [
        'client_id',
        'description_location_value'
    ];

    /**
     * Relación con el modelo Client (Muchos a Uno)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
