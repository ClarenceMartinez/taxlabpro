<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPeriod extends Model
{
    use HasFactory;

    protected $table = 'pay_periods'; // Nombre de la tabla en la BD

    protected $fillable = ['name']; // Campos permitidos para asignación masiva
}
