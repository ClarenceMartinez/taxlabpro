<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivedAbroad extends Model {
    use HasFactory;
    protected $table = 'lived_abroad';
    protected $fillable = ['client_id', 'lived_abroad_from', 'lived_abroad_to'];
    public function client() {
        return $this->belongsTo(Client::class);
    }
}
