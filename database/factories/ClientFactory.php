<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; 

class ClientFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente de la factoría.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Opciones para los ENUMs y valores fijos
        $formTypes = ['433A', '433A OIC', '433B', '433B OIC'];
        $addressTypes = ['1', '2'];
        $maritalStatuses = ['1', '2']; // Asumimos 1=Soltero, 2=Casado (o similar)
        $yesNoUnknown = ['unknown', 'no', 'yes'];
        $states = ['CA', 'NV', 'AZ', 'TX', 'FL', 'NY', 'IL']; // Ejemplo de estados
        $caseStatuses = ['New', 'In Progress', 'Pending Docs', 'On Hold', 'Resolved', 'Closed'];
        $businessTypes = ['Sole Proprietorship', 'Partnership', 'LLC', 'S-Corp', 'C-Corp'];

        // Decide si el cliente está casado para rellenar campos del cónyuge
        // Nota: Tu schema indica que los campos de cónyuge son NOT NULL.
        // Esto es inusual si alguien no está casado. Para cumplir el schema,
        // generaremos datos para el cónyuge siempre, pero podrías ajustar
        // esto si cambias el schema a NULLABLE para esos campos.
        $isMarried = fake()->randomElement($maritalStatuses) == '2';

        return [
            // Información Principal
            'form_type' => fake()->randomElement($formTypes),
            'first_name' => fake()->firstName(),
            'mi' => strtoupper(fake()->randomLetter()), // Middle Initial
            'last_name' => fake()->lastName(),
            'ssn' => fake()->numerify('###-##-####'), // Formato SSN USA
            'date_birdth' => fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'dl' => fake()->bothify('?#######'), // Driver's License number
            'dl_state' => fake()->randomElement($states),
            'has_passport' => fake()->randomElement(['yes', 'no']), // Asumiendo 'yes'/'no' como strings
            'client_reference' => 'CL-' . fake()->unique()->randomNumber(3),
            'saludation_for_letter' => 'Dear ' . fake()->title() . ' ' . fake()->lastName(),

            // Dirección Principal
            'type_address' => fake()->randomElement($addressTypes),
            'address_1' => fake()->streetAddress(),
            'address_2' => fake()->secondaryAddress(), 
            'city' => fake()->city(),
            'state' => fake()->randomElement($states),
            'zipcode' => fake()->postcode(),
            'country' => 'USA', // O puedes usar fake()->country()

            // Dirección de Correo (si es diferente) - Generamos una de todos modos
            'm_address_1' => fake()->streetAddress(),
            'm_address_2' => fake()->secondaryAddress(),
            'm_city' => fake()->city(),
            'm_state' => fake()->randomElement($states),
            'm_zipcode' => fake()->postcode(),

            // Estado Civil e Información del Cónyuge (Generando siempre por NOT NULL)
            'marital_status' => $maritalStatuses[1], // Forzamos 'casado' o usa fake()->randomElement($maritalStatuses)
            'marital_date' => fake()->dateTimeBetween('-30 years', '-1 year')->format('Y-m-d'),
            'spouse_first_name' => fake()->firstName(),
            'spouse_mi' => strtoupper(fake()->randomLetter()),
            'spouse_last_name' => fake()->lastName(),
            'spouse_ssn' => fake()->numerify('###-##-####'),
            'spouse_date_birdth' => fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'spouse_dl' => fake()->bothify('?#######'),
            'spouse_dl_state' => fake()->randomElement($states),
            'spouse_has_passport' => fake()->randomElement(['yes', 'no']),
            'spouse_saludation_for_letter' => 'Dear ' . fake()->title() . ' ' . fake()->lastName(),

            // Información de Contacto Principal
            'phone_home' => fake()->phoneNumber(),
            'cell_home' => fake()->phoneNumber(),
            'fax_home' => fake()->phoneNumber(), // Opcional
            'phone_work' => fake()->phoneNumber(),
            'cell_work' => fake()->phoneNumber(),
            'fax_work' => fake()->phoneNumber(), // Opcional
            'tax_payer_email' => fake()->unique()->safeEmail(),

             // Información de Contacto Cónyuge (Generando siempre por NOT NULL)
            'spouse_phone_home' => fake()->phoneNumber(),
            'spouse_cell_home' => fake()->phoneNumber(),
            'spouse_fax_home' => fake()->phoneNumber(),
            'spouse_phone_work' => fake()->phoneNumber(),
            'spouse_cell_work' => fake()->phoneNumber(),
            'spouse_fax_work' => fake()->phoneNumber(),
            'spouse_email' => fake()->unique()->safeEmail(),

            // Metadatos y Estado
            'estatus' => fake()->randomElement([0, 1]), // 0 o 1
            'tags' => implode(',', fake()->words(fake()->numberBetween(1, 4))), // Algunos tags
            'monitor' => fake()->randomElement(['Monitor A', 'Monitor B', 'None']),
            'type' => fake()->randomElement(['Individual', 'Business']), // Tipo de cliente
            'avatar' => fake()->numberBetween(1, 10), // ID de avatar placeholder
            'company_id' => 1, // Asume que existe una compañía con ID 1. O usa \App\Models\Company::factory() si tienes esa factory.
            'case_status' => fake()->randomElement($caseStatuses),

            // Campos ENUM ('unknown', 'no', 'yes') - Sección 1 (Household, Employment, etc.)
            'household_dependents' => fake()->randomElement($yesNoUnknown),
            'taxpayer_employed' => fake()->randomElement($yesNoUnknown),
            'spouse_employed' => fake()->randomElement($yesNoUnknown),
            'business_interest' => fake()->randomElement($yesNoUnknown),
            'lawsuit_party' => fake()->randomElement($yesNoUnknown),
            'irs_lawsuit_party' => fake()->randomElement($yesNoUnknown),
            'bankruptcy_status' => fake()->randomElement($yesNoUnknown),
            'filed_bankruptcy' => fake()->randomElement($yesNoUnknown),
            'trust_beneficiary' => fake()->randomElement($yesNoUnknown),
            'funds_held_in_trust' => fake()->randomElement($yesNoUnknown),
            'trustee_fiduciary_contributor' => fake()->randomElement($yesNoUnknown),
            'safe_deposit_box' => fake()->randomElement($yesNoUnknown),
            'lived_outside_us' => fake()->randomElement($yesNoUnknown),
            'foreign_assets' => fake()->randomElement($yesNoUnknown),

             // Campos ENUM ('unknown', 'no', 'yes') - Sección 2 (Assets)
            'personal_bank_accounts' => fake()->randomElement($yesNoUnknown),
            'investment_accounts' => fake()->randomElement($yesNoUnknown),
            'digital_assets' => fake()->randomElement($yesNoUnknown),
            'retirement_accounts' => fake()->randomElement($yesNoUnknown),
            'available_credit' => fake()->randomElement($yesNoUnknown),
            'life_insurance_cash_value' => fake()->randomElement($yesNoUnknown),
            'assets_transferred_10_years' => fake()->randomElement($yesNoUnknown),
            'real_estate_transferred_3_years' => fake()->randomElement($yesNoUnknown),
            'own_real_property' => fake()->randomElement($yesNoUnknown),
            'real_property_for_sale' => fake()->randomElement($yesNoUnknown),
            'own_vehicles' => fake()->randomElement($yesNoUnknown),
            'other_valuable_assets' => fake()->randomElement($yesNoUnknown),

            // Campos ENUM ('unknown', 'no', 'yes') - Sección 3 (Business Specific)
            'business_ecommerce_virtual_currency' => fake()->randomElement($yesNoUnknown),
            'business_accept_credit_card' => fake()->randomElement($yesNoUnknown),
            'business_bank_accounts' => fake()->randomElement($yesNoUnknown),
            'business_digital_assets' => fake()->randomElement($yesNoUnknown),
            'business_accounts_receivable' => fake()->randomElement($yesNoUnknown),
            'business_tools_equipment' => fake()->randomElement($yesNoUnknown),
            'business_intangible_assets' => fake()->randomElement($yesNoUnknown),

            // Campos ENUM ('unknown', 'no', 'yes') - Sección 4 (Additional Questions 433B/OIC)
            'outside_us_6mos' => fake()->randomElement($yesNoUnknown),
            'enrolled_eftps' => fake()->randomElement($yesNoUnknown),
            'engage_ecommerce' => fake()->randomElement($yesNoUnknown),
            'accept_credit_cards' => fake()->randomElement($yesNoUnknown),
            'partners_officers' => fake()->randomElement($yesNoUnknown),
            'other_business_affiliations' => fake()->randomElement($yesNoUnknown),
            'payroll_service_provider' => fake()->randomElement($yesNoUnknown),
            'related_parties_owe_business' => fake()->randomElement($yesNoUnknown),
            'business_party_lawsuit' => fake()->randomElement($yesNoUnknown),
            'taxpayer_party_lawsuit_irs' => fake()->randomElement($yesNoUnknown),
            'business_currently_bankrupt' => fake()->randomElement($yesNoUnknown),
            'business_ever_filed_bankruptcy' => fake()->randomElement($yesNoUnknown),
            'assets_transferred_less_value' => fake()->randomElement($yesNoUnknown),
            'real_estate_transferred_3yrs' => fake()->randomElement($yesNoUnknown),
            'income_increase_decrease' => fake()->randomElement($yesNoUnknown),
            'safe_on_premises' => fake()->randomElement($yesNoUnknown),
            'accounts_notes_receivable' => fake()->randomElement($yesNoUnknown),
            'owns_real_property' => fake()->randomElement($yesNoUnknown), // Duplicado? Ya estaba en 79. Usando el mismo valor.
            'outside_us_assets' => fake()->randomElement($yesNoUnknown),
            'vehicles_leased_purchased' => fake()->randomElement($yesNoUnknown),
            'intangible_assets' => fake()->randomElement($yesNoUnknown),
            'business_liabilities' => fake()->randomElement($yesNoUnknown),


            // Campos NULLABLES (Algunos se rellenarán opcionalmente)
            'listing_price' => fake()->optional(0.4)->randomFloat(2, 50000, 1000000), // Precio si está en venta
            'outside_us_assets_description' => fake()->paragraph(), // Descripción si tiene activos fuera
            'type_of_business' => fake()->randomElement($businessTypes),
            'business_name' => fake()->company(),
            'business_address' => fake()->address(), // Dirección completa en una línea
            'business_email_address' => fake()->companyEmail(),
            'business_phone' => fake()->phoneNumber(),
            'business_ein' => fake()->numerify('##-#######'), // Formato EIN
            'type_of_entity' => fake()->numberBetween(1, 5), // Asume IDs de tipos de entidad
            'date_established' => fake()->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d'),
            'business_website' => fake()->url(),
            'total_number_of_employees' => fake()->numberBetween(1, 500),
            'average_gross_monthly_payroll' => fake()->randomFloat(2, 5000, 250000),
            'frequency_tax_deposits' => fake()->randomElement(['Monthly', 'Semi-Weekly', 'Quarterly']),
            'cash_on_hand' => fake()->randomFloat(2, 100, 5000),
            'trade_name' => fake()->company(), // DBA Name
            'business_street' => fake()->streetAddress(), // Campo específico de calle
            'business_city' => fake()->city(),
            'business_state' => fake()->randomElement($states),
            'business_zip_code' => fake()->postcode(),


            // Campos TINYINT(1) con default 0
            'federal_contractor' => fake()->boolean(10), // 10% de probabilidad de ser true (1)
            'sole_proprietorship' => fake()->boolean(30), // 30% de probabilidad de ser true (1)

            // Timestamps: created_at y updated_at son manejados por Eloquent automáticamente
            // 'deleted_at' será NULL por defecto
        ];
    }
}