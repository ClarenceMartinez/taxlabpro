<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAbroad extends Model {
    use HasFactory;
    protected $table = 'assets_abroad';
    protected $fillable = ['client_id', 'description'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}