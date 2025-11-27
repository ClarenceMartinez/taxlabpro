<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceProcessor extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'ecommerce_processors';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'client_id',
        'processor_name',
        'account_number',
        'street_address',
        'city_state_zip',
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
