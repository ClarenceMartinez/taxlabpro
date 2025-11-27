<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFinancial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'period_start',
        'period_end',
        'gross_receipts',
        'gross_rental_income',
        'interest',
        'dividends',
        'cash_receipts',
        'materials_purchased',
        'inventory_purchased',
        'wages_salaries',
        'rent',
        'supplies',
        'utilities',
        'vehicle_gas_oil',
        'repairs_maintenance',
        'insurance',
        'current_taxes',
        'total_income',
        'total_expense',
        'net_balance',
        
        // 35. Food, Clothing and Misc:
        'expenses_food',
        'expenses_housekeeping_supplies',
        'expenses_clothing',
        'expenses_personal_care_products',
        'expenses_credit_card_payments',
        'expenses_bank_fees',
        'expenses_school_supplies',
        'expenses_miscellaneous',

        // 36. Housing and Utilities:
        'expenses_mortgage',
        'expenses_homeowners_insurance',
        'expenses_rent',
        'expenses_renters_insurance',
        'expenses_real_estate_taxes',
        'expenses_housing_maintenance',
        'expenses_dues',
        'expenses_fees',
        'expenses_repairs',
        'expenses_electric',
        'expenses_natural_gas',
        'expenses_water',
        'expenses_trash_collection',
        'expenses_home_phone',
        'expenses_cellphone',
        'expenses_internet',
        'expenses_cable',
        'expenses_oil',
        'expenses_fuel',
        'expenses_other_fuels',

        // 37. Vehicle Ownership Costs:
        'expenses_car_loan_payment',
        'expenses_car_lease_payment',

        // 38. Vehicle Operating Costs:
        'expenses_vehicle_maintenance',
        'expenses_vehicle_repairs',
        'expenses_vehicle_insurance',
        'expenses_vehicle_fuel',
        'expenses_vehicle_registrations',
        'expenses_vehicle_licenses',
        'expenses_parking',
        'expenses_inspections',
        'expenses_tolls',

        // 39. Public Transportation:
        'expenses_bus',
        'expenses_train',
        'expenses_ferry',
        'expenses_taxi',
        'expenses_ride_share',

        // 40. Health Insurance:
        'expenses_health_insurance',
        'expenses_dental_insurance',
        'expenses_vision_insurance',

        // 41. Out-of-pocket Health Care:
        'expenses_medical_services',
        'expenses_prescription_drugs',
        'expenses_medical_supplies',
        'expenses_medical_equipment',
        'expenses_eyeglasses',
        'expenses_contacts',
        'expenses_hearing_aids',

        // 42. Court Ordered Payments:
        'expenses_alimony',
        'expenses_child_support',
        'expenses_restitution',

        // 43. Child/Dependent Care:
        'expenses_daycare',
        'expenses_babysitter_fees',
        'expenses_elder_care',

        // 44. Life Insurance:
        'expenses_life_insurance',

        // 45. Current Year Taxes:
        'expenses_w2_federal',
        'expenses_w2_state',
        'expenses_fed_estimated_taxes',
        'expenses_state_estimated_taxes',
        'expenses_social_security',
        'expenses_medicare',

        // 46. Secured Debts:
        'expenses_heloc',
        'expenses_personal_loan',
        'expenses_student_loans',
        'expenses_secured_cc',
        'expenses_cd_loans',
        'expenses_jewelry',
        'expenses_stocks_bonds',

        // 47. Delinquent Taxes:
        'expenses_state_taxes',
        'expenses_property_taxes',
        'expenses_sales_taxes',
        'expenses_local_taxes',

        // 48. Other Expenses:
        'expenses_pet_related',
        'expenses_charitable_contributions',
        'expenses_legal_fees',
        'expenses_disability_expenses',
        'expenses_professional_dues',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
