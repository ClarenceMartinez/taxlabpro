<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Correcto


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'description',
        'due_date',
    ];

    

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->hasMany(TaskStep::class);
    }
}
