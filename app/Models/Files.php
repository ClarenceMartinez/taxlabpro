<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Es buena práctica añadirlo si usas factories

class Files extends Model
{
    use HasFactory; // Añadir esto si usas factories, sino es opcional

    protected $table = 'files';

    protected $fillable = [
        'client_id',
        'user_id',
        'url',
        'ext',
        // 'original_name', // Considera añadir esto si quieres guardar el nombre original del archivo
    ];

    /**
     * The attributes that should be cast.
     * Esto es importante para que Laravel trate las fechas como objetos Carbon.
     * Si no las casteas, podrías tener problemas al formatearlas.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtiene el usuario que subió el archivo.
     * Define la relación "belongsTo" con el modelo User.
     */
    public function user()
    {
        // Asume que 'user_id' en la tabla 'files' es la clave foránea
        // que referencia a la columna 'id' en la tabla 'users'.
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtiene el cliente al que pertenece el archivo.
     * Define la relación "belongsTo" con el modelo Client.
     */
    public function client()
    {
        // Asume que 'client_id' en la tabla 'files' es la clave foránea
        // que referencia a la columna 'id' en la tabla 'clients'.
        return $this->belongsTo(Client::class, 'client_id');
    }
}