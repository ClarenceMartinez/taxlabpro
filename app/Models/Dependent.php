<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'age',
        'relationship',
        'claimed_as_dependent',
        'contributes_income'
    ];
}
