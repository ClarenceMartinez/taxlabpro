<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('household_dependents', ['unknown', 'no', 'yes'])->default('unknown')->after('case_status');
            $table->enum('taxpayer_employed', ['unknown', 'no', 'yes'])->default('unknown')->after('household_dependents');
            $table->enum('spouse_employed', ['unknown', 'no', 'yes'])->default('unknown')->after('taxpayer_employed');
            $table->enum('business_interest', ['unknown', 'no', 'yes'])->default('unknown')->after('spouse_employed');


            $table->enum('lawsuit_party', ['unknown', 'no', 'yes'])->default('unknown')->after('business_interest');
            $table->enum('irs_lawsuit_party', ['unknown', 'no', 'yes'])->default('unknown')->after('lawsuit_party');
            $table->enum('bankruptcy_status', ['unknown', 'no', 'yes'])->default('unknown')->after('irs_lawsuit_party');
            $table->enum('filed_bankruptcy', ['unknown', 'no', 'yes'])->default('unknown')->after('bankruptcy_status');
            $table->enum('trust_beneficiary', ['unknown', 'no', 'yes'])->default('unknown')->after('filed_bankruptcy');
            $table->enum('funds_held_in_trust', ['unknown', 'no', 'yes'])->default('unknown')->after('trust_beneficiary');
            $table->enum('trustee_fiduciary_contributor', ['unknown', 'no', 'yes'])->default('unknown')->after('funds_held_in_trust');
            $table->enum('safe_deposit_box', ['unknown', 'no', 'yes'])->default('unknown')->after('trustee_fiduciary_contributor');
            $table->enum('lived_outside_us', ['unknown', 'no', 'yes'])->default('unknown')->after('safe_deposit_box');
            $table->enum('foreign_assets', ['unknown', 'no', 'yes'])->default('unknown')->after('lived_outside_us');

            $table->enum('personal_bank_accounts', ['unknown', 'no', 'yes'])->default('unknown')->after('foreign_assets');
            $table->enum('investment_accounts', ['unknown', 'no', 'yes'])->default('unknown')->after('personal_bank_accounts');
            $table->enum('digital_assets', ['unknown', 'no', 'yes'])->default('unknown')->after('investment_accounts');
            $table->enum('retirement_accounts', ['unknown', 'no', 'yes'])->default('unknown')->after('digital_assets');
            $table->enum('available_credit', ['unknown', 'no', 'yes'])->default('unknown')->after('retirement_accounts');
            $table->enum('life_insurance_cash_value', ['unknown', 'no', 'yes'])->default('unknown')->after('available_credit');
            $table->enum('assets_transferred_10_years', ['unknown', 'no', 'yes'])->default('unknown')->after('life_insurance_cash_value');
            $table->enum('real_estate_transferred_3_years', ['unknown', 'no', 'yes'])->default('unknown')->after('assets_transferred_10_years');

            $table->enum('own_real_property', ['unknown', 'no', 'yes'])->default('unknown')->after('real_estate_transferred_3_years');
            $table->enum('real_property_for_sale', ['unknown', 'no', 'yes'])->default('unknown')->after('own_real_property');
            $table->enum('own_vehicles', ['unknown', 'no', 'yes'])->default('unknown')->after('real_property_for_sale');
            $table->enum('other_valuable_assets', ['unknown', 'no', 'yes'])->default('unknown')->after('own_vehicles');


            $table->enum('business_ecommerce_virtual_currency', ['unknown', 'no', 'yes'])->default('unknown')->after('other_valuable_assets');
            $table->enum('business_accept_credit_card', ['unknown', 'no', 'yes'])->default('unknown')->after('business_ecommerce_virtual_currency');
            $table->enum('business_bank_accounts', ['unknown', 'no', 'yes'])->default('unknown')->after('business_accept_credit_card');
            $table->enum('business_digital_assets', ['unknown', 'no', 'yes'])->default('unknown')->after('business_bank_accounts');
            $table->enum('business_accounts_receivable', ['unknown', 'no', 'yes'])->default('unknown')->after('business_digital_assets');
            $table->enum('business_tools_equipment', ['unknown', 'no', 'yes'])->default('unknown')->after('business_accounts_receivable');
            $table->enum('business_intangible_assets', ['unknown', 'no', 'yes'])->default('unknown')->after('business_tools_equipment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
