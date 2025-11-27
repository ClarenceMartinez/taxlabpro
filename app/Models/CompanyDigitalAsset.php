<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDigitalAsset extends Model
{
    use HasFactory;

    protected $table = 'company_digital_assets';

    protected $fillable = [
        'client_id',
        'description',
        'account_number',
        'number_of_units',
        'digital_address',
        'location',
        'current_value',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
