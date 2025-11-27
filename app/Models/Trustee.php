<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trustee extends Model
{
    use HasFactory;
    protected $table = 'trustees';
    protected $fillable = [
        'client_id',
        'trust_name',
        'ein',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
