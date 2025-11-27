<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccountReceivable extends Model
{
    use HasFactory;

    protected $table = 'company_accounts_receivable';

    protected $fillable = [
        'client_id',
        'account_description',
        'address',
        'city_state_zip',
        'contact',
        'phone',
        'status',
        'due_date',
        'invoice_no',
        'amount_due',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
