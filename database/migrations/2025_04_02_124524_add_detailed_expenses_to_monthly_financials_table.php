<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Asegúrate de importar DB si lo necesitas en otras partes, aunque no en este 'down' específico
// use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * La lista de campos de gastos que se añadirán/eliminarán.
     * Definida una sola vez aquí.
     * Usamos 'protected' o 'private' ya que solo se usa dentro de esta clase.
     */
    protected array $expenseFields = [
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

    /**
     * El nombre de la tabla que estamos modificando.
     * Útil para evitar repetirlo también.
     */
    protected string $tableName = 'monthly_financials';


    public function up(): void
    {
        // Usamos Schema::table para modificar una tabla existente
        Schema::table($this->tableName, function (Blueprint $table) {
            // Iteramos sobre la propiedad de la clase $this->expenseFields
            foreach ($this->expenseFields as $field) {
                // Verificamos si la columna NO existe antes de añadirla
                if (!Schema::hasColumn($this->tableName, $field)) {
                    // Añadimos la columna decimal, nullable
                    $table->decimal($field, 12, 2)->nullable();
                     // Si quisieras añadirla después de una columna específica:
                     // $table->decimal($field, 12, 2)->nullable()->after('distributions');
                     // Pero añadir muchas columnas con 'after' puede ser lento en algunas BDs.
                     // Es más simple dejarlas al final por defecto si el orden no es crítico.
                }
            }
        });
    }

    public function down(): void
    {
        // Usamos Schema::table para modificar la tabla existente
        Schema::table($this->tableName, function (Blueprint $table) {
            // Preparamos un array para las columnas que realmente existen y necesitamos eliminar
            $columnsToDrop = [];
            // Iteramos sobre la MISMA propiedad de la clase $this->expenseFields
            foreach ($this->expenseFields as $field) {
                // Verificamos si la columna SÍ existe antes de intentar eliminarla
                // Esto hace el rollback más robusto por si algo falló o se ejecutó parcialmente
                if (Schema::hasColumn($this->tableName, $field)) {
                    $columnsToDrop[] = $field;
                }
            }

            // Solo intentamos eliminar si encontramos columnas para ello
            if (!empty($columnsToDrop)) {
                 // Usamos dropColumn con el array de columnas que existen
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};