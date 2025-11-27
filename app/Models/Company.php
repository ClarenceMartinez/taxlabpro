<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Company extends Model
{
    //
    protected $table = 'company';

    protected $fillable=[
    	'name',
        'slug',
    	'state_id',
    	'city',
    	'address_1',
    	'address_2',
    	'office_phone',
    	'office_cell',
    	'status',
    	'user_id'
    ];



    public function getEncryptedSlugAttribute(): string
    {
        return Crypt::encryptString($this->slug);
    }
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    public function servicesOffered()
    {
        return $this->hasMany(CompanyService::class);
    }

}
