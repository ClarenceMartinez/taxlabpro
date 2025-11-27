<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'account_types';

    // Define the fields that can be mass-assigned
    protected $fillable = ['name'];

    // Optionally, you can specify hidden fields for security purposes, like:
    // protected $hidden = ['created_at', 'updated_at'];
}
