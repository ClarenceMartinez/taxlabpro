<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    use HasFactory;

    protected $table = 'receivables'; // opcional si sigues la convención

    protected $fillable = [
        'client_id',
        'type',
        'account_description',
        'status',
        'due_date',
        'invoice_no',
        'amount_due',
        'address',
        'city',
        'state',
        'zip',
        'contact',
        'phone',
    ];

    /**
     * Relación con el modelo Client (Muchos a Uno)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
