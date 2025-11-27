<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'telephone',
        'password',
        'type',
        'status',
        'avatar',
        'company_id',
        // nuevos campos:
        'timezone',
        'email_signature',
        'poa1_description',
        'poa1_form_number',
        'poa1_period',
        'poa2_description',
        'poa2_form_number',
        'poa2_period',
        'poa3_description','poa3_form_number','poa3_period',
        // POA Businesses
        'poa_bus1_description','poa_bus1_form_number','poa_bus1_period',
        'poa_bus2_description','poa_bus2_form_number','poa_bus2_period',
        'poa_bus3_description','poa_bus3_form_number','poa_bus3_period',

         // … otros ya existentes …
        'firm_ein',
        'caf_no',
        'ptin',
        'ctec',
        'ny_tprin',
        'designation',
        'licensing_jurisdiction',
        'license_no',
        'a2a',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullName()
    {
        return "{$this->name}";
    }
    
    public static function infoClient($id)
    {
        $result = DB::select("SELECT id, `name`, company_id, email FROM users WHERE id = ?", [$id]);
        return !empty($result) ? $result[0] : null; // Retorna el primer registro o null si no hay resultados
    }

    public static function getUserAdminByCompany($id)
    {
        return DB::select("SELECT id FROM users WHERE `type` = 2 AND company_id = ?", array($id));
    }

    public static function getUserAdminByCompanyGeneral()
    {
        return DB::select("SELECT id FROM users WHERE `type` = 2");
    }

    public function userClients()
    {
        return $this->hasMany(UserClient::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'user_to_client');
    }
}
