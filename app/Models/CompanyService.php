<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;

    protected $table = 'company_services'; // opcional si sigue la convención

    protected $fillable = [
        'company_id',
        'service_name',
        'description',
    ];

    /**
     * Relación con el modelo Company (Muchos a Uno)
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
