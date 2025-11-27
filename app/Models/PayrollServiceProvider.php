<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'payroll_service_providers';

    protected $fillable = [
        'client_id',
        'provider_name',
        'address',
        'city_state_zip',
        'effective_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
