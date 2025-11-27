<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxpayerLawsuitIrs extends Model
{
    use HasFactory;

    protected $table = 'taxpayer_lawsuits_irs';

    protected $fillable = [
        'client_id',
        'types_of_tax_and_periods',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
