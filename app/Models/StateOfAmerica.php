<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateOfAmerica extends Model
{
    use HasFactory;

    protected $table = 'states_of_america'; // Nombre de la tabla

    protected $fillable = ['name', 'abrev', 'zipcode']; // Columnas permitidas para inserción masiva
}
