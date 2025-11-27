<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAssetTransfer extends Model
{
    use HasFactory;

    protected $table = 'business_asset_transfers';

    protected $fillable = [
        'client_id',
        'asset',
        'date_transferred',
        'value_at_time_of_transfer',
        'where_transferred',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
