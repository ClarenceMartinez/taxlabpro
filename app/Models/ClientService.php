<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    use HasFactory;

    protected $table = 'client_services';

    protected $fillable = [
        'client_id',
        'service_id',
    ];

    /**
     * Relación: Un servicio pertenece a un cliente.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
