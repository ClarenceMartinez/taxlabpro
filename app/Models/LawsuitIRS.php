<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawsuitIRS extends Model {
    use HasFactory;

    protected $table = 'lawsuits_irs';
    protected $fillable = [
        'client_id',
        'name'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}