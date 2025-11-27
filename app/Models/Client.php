<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Str;
use App\Observers\ClientObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;


#[ObservedBy([ClientObserver::class])]
class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id';

    protected $fillable=[
    	'first_name',
    	'mi',
    	'last_name',
        'slug',    
        'deal',
        'deal_pay',
        'owed',
        'storage_path',
    	'ssn',
    	'date_birdth',
    	'dl',
    	'dl_state',
    	'has_passport',
    	'client_reference',
    	'saludation_for_letter',
    	'type_address',
    	'address_1',
    	'address_2',
    	'city',
    	'state',
    	'zipcode',
    	'country',
    	'm_address_1',
    	'm_address_2',
    	'm_city',
    	'm_state',
    	'm_zipcode',
    	'marital_status',
    	'marital_date',
    	'spouse_first_name',
    	'spouse_mi',
    	'spouse_last_name',
    	'spouse_ssn',
    	'spouse_date_birdth',
    	'spouse_dl',
    	'spouse_dl_state',
    	'spouse_has_passport',
    	'spouse_saludation_for_letter',
    	'phone_home',
    	'cell_home',
    	'fax_home',
    	'phone_work',
    	'cell_work',
    	'fax_work',
    	'spouse_phone_home',
    	'spouse_cell_home',
    	'spouse_fax_home',
    	'spouse_phone_work',
    	'spouse_cell_work',
    	'spouse_fax_work',
    	'tax_payer_email',
    	'spouse_email',
    	'estatus',
    	'tags',
    	'monitor',
    	'type',
    	'avatar',
    	'company_id',
		'case_status',
		'business_name',
		'business_address',
		'business_email_address',
		'business_phone',
		'trade_name',
		'business_street',
		'business_city',
		'business_state',
		'business_zip_code',
		'sole_proprietorship',
		'federal_contractor'

    ];

    /**
    * Date time columns.
    */
    protected $dates=[];

    public function activities()
    {
        return $this->hasMany(Activities::class, 'client_id');
    }

    public function files()
    {
        return $this->hasMany(Files::class, 'client_id');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'client_id');
    }

    public function userClients()
    {
        return $this->belongsToMany(User::class, 'user_to_client', 'client_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_to_client');
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class); // o el nombre del modelo correcto
    }

    public function dependents()
    {
        return $this->hasMany(Dependent::class); // o el nombre del modelo correcto
    }

    public function employment()
    {
        return $this->hasMany(Employment::class); // o el nombre del modelo correcto
    }

    public function employment_spouse()
    {
        return $this->hasMany(EmploymentSpouse::class); // o el nombre del modelo correcto
    }

    public function business_interests()
    {
        return $this->hasMany(BusinessInterest::class); // o el nombre del modelo correcto
    }

    public function lawsuits()
    {
        return $this->hasMany(Lawsuit::class); // o el nombre del modelo correcto
    }

    public function lawsuit_irs()
    {
        return $this->hasMany(LawsuitIRS::class); // o el nombre del modelo correcto
    }

    public function bankruptcies()
    {
        return $this->hasMany(Bankruptcy::class); // o el nombre del modelo correcto
    }

    public function beneficiaries_insurance()
    {
        return $this->hasMany(BeneficiaryInsurance::class); // o el nombre del modelo correcto
    }

    public function trustees()
    {
        return $this->hasMany(Trustee::class); // o el nombre del modelo correcto
    }

    public function trustFunds()
    {
        return $this->hasMany(TrustFund::class); // o el nombre del modelo correcto
    }

    public function safeDepositBoxes()
    {
        return $this->hasMany(SafeDepositBox::class); // o el nombre del modelo correcto
    }

    public function livedAbroads()
    {
        return $this->hasMany(LivedAbroad::class); // o el nombre del modelo correcto
    }

    public function assetAbroads()
    {
        return $this->hasMany(AssetAbroad::class); // o el nombre del modelo correcto
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class); // o el nombre del modelo correcto
    }

    public function investmentAccounts()
    {
        return $this->hasMany(InvestmentAccount::class); // o el nombre del modelo correcto
    }

    public function digitalAssets()
    {
        return $this->hasMany(DigitalAsset::class); // o el nombre del modelo correcto
    }

    public function retirementAccounts()
    {
        return $this->hasMany(RetirementAccount::class); // o el nombre del modelo correcto
    }  
    public function userClientEntries()
    {
        return $this->hasMany(UserClient::class, 'client_id');
    }

    public function creditAccounts()
    {
        return $this->hasMany(CreditAccount::class); // o el nombre del modelo correcto
    }
    
    public function lifeInsurances()
    {
        return $this->hasMany(LifeInsurance::class); // o el nombre del modelo correcto
    }
    
    public function assetTransfers()
    {
        return $this->hasMany(AssetTransfer::class); // o el nombre del modelo correcto
    }
    
    public function realEstateTransfers()
    {
        return $this->hasMany(RealEstateTransfer::class); // o el nombre del modelo correcto
    }
     public function stateOfAmerica()
    {
        return $this->belongsTo(StateOfAmerica::class, 'state');
    }
   
    public function typeResidence()
    {
        return $this->hasMany(TypeResidence::class); // o el nombre del modelo correcto
    }
    
    public function properties()
    {
        return $this->hasMany(Property::class); // o el nombre del modelo correcto
    }
    
    public function propertySales()
    {
        return $this->hasMany(PropertySale::class); // o el nombre del modelo correcto
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class); // o el nombre del modelo correcto
    }
    
    public function otherAssets()
    {
        return $this->hasMany(OtherAsset::class); // o el nombre del modelo correcto
    }

    public function paymentProcessors()
    {
        return $this->hasMany(PaymentProcessor::class); // o el nombre del modelo correcto
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class); // o el nombre del modelo correcto
    }

    public function businessBankAccounts()
    {
        return $this->hasMany(BusinessBankAccount::class); // o el nombre del modelo correcto
    }

    public function companyBankAccounts()
    {
        return $this->hasMany(CompanyBankAccount::class); // o el nombre del modelo correcto
    }

    public function companyDigitalAssets()
    {
        return $this->hasMany(CompanyDigitalAsset::class); // o el nombre del modelo correcto
    }

    public function companyAccountReceivables()
    {
        return $this->hasMany(CompanyAccountReceivable::class); // o el nombre del modelo correcto
    }

    public function companyToolEquipments()
    {
        return $this->hasMany(CompanyToolEquipment::class); // o el nombre del modelo correcto
    }

    public function companyIntangibleAssets()
    {
        return $this->hasMany(CompanyIntangibleAsset::class); // o el nombre del modelo correcto
    }

    public function incomeExpensePeriods()
    {
        return $this->hasMany(IncomeExpensePeriod::class); // o el nombre del modelo correcto
    }

    public function ecommerceProcessors()
	{
	    return $this->hasMany(EcommerceProcessor::class, 'client_id');
	}

	public function partnersOfficers()
	{
	    return $this->hasMany(PartnerOfficer::class, 'client_id');
	}

	public function businessAffiliations()
	{
	    return $this->hasMany(BusinessAffiliation::class, 'client_id');
	}

	public function payrollServiceProviders()
	{
	    return $this->hasMany(PayrollServiceProvider::class, 'client_id');
	}

	public function relatedPartiesOweBusiness()
	{
	    return $this->hasMany(RelatedPartyOweBusiness::class, 'client_id');
	}

	public function taxpayerLawsuitsIrs()
	{
	    return $this->hasMany(TaxpayerLawsuitIrs::class, 'client_id');
	}

	public function businessAssetTransfers()
	{
	    return $this->hasMany(BusinessAssetTransfer::class, 'client_id');
	}

	public function incomeChanges()
    {
        return $this->hasMany(IncomeChange::class, 'client_id');
    }

    public function safe()
    {
        return $this->hasMany(Safe::class, 'client_id');
    }

    public function receivables()
    {
        return $this->hasMany(Receivable::class, 'client_id');
    }

    public function creditLines()
    {
        return $this->hasMany(CreditLine::class);
    }


    public function foreignProperties()
    {
        return $this->hasMany(ForeignProperty::class);
    }

    public function intangibleAssets()
    {
        return $this->hasMany(IntangibleAsset::class);
    }

    public function businessLiabilities()
    {
        return $this->hasMany(BusinessLiability::class);
    }

    public function monthlyFinancial()
    {
        return $this->hasMany(MonthlyFinancial::class);
    }


    public function getEncryptedSlugAttribute(): string
    {
        return Crypt::encryptString($this->slug);
    }
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    protected static function booted()
    {
        static::creating(function ($client) {
            // Aquí aún no tienes el ID, así que usa un slug temporal
            $client->slug = Str::slug($client->first_name .' '.$client->last_name);
        });

        static::created(function ($client) {
            // Ahora sí tienes el ID, puedes actualizar el slug
            $client->slug = Str::slug($client->first_name .' '.$client->last_name . ' ' . $client->id);
            $client->save();
        });

        static::updating(function ($client) {
            $client->slug = Str::slug($client->first_name .' '.$client->last_name . ' ' . $client->id);
        });
    }

}
