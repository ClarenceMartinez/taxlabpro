<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawsuit extends Model {
    use HasFactory;

    protected $fillable = [
        'client_id',
        'role',
        'subject_of_suit',
        'location_of_filing',
        'city',
        'represented_by',
        'amount_of_suit',
        'docket_case_number',
        'possible_completion_date'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}