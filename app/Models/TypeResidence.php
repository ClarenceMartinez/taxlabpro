<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeResidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'status',
        'monthly_rent',
        'other_description',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
