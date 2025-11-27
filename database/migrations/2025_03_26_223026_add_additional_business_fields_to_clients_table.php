<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Valida columna por columna
            if (!Schema::hasColumn('clients', 'outside_us_6mos')) {
                $table->enum('outside_us_6mos', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'enrolled_eftps')) {
                $table->enum('enrolled_eftps', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'engage_ecommerce')) {
                $table->enum('engage_ecommerce', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'accept_credit_cards')) {
                $table->enum('accept_credit_cards', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'partners_officers')) {
                $table->enum('partners_officers', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'other_business_affiliations')) {
                $table->enum('other_business_affiliations', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'payroll_service_provider')) {
                $table->enum('payroll_service_provider', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'related_parties_owe_business')) {
                $table->enum('related_parties_owe_business', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'business_party_lawsuit')) {
                $table->enum('business_party_lawsuit', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'taxpayer_party_lawsuit_irs')) {
                $table->enum('taxpayer_party_lawsuit_irs', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'business_currently_bankrupt')) {
                $table->enum('business_currently_bankrupt', ['unknown','no','yes'])->default('unknown');
            }

            if (!Schema::hasColumn('clients', 'business_ever_filed_bankruptcy')) {
                $table->enum('business_ever_filed_bankruptcy', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'assets_transferred_less_value')) {
                $table->enum('assets_transferred_less_value', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'real_estate_transferred_3yrs')) {
                $table->enum('real_estate_transferred_3yrs', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'income_increase_decrease')) {
                $table->enum('income_increase_decrease', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'safe_on_premises')) {
                $table->enum('safe_on_premises', ['unknown','no','yes'])->default('unknown');
            }
            // $table->enum('funds_held_in_trust', ['unknown','no','yes'])->default('unknown');

            if (!Schema::hasColumn('clients', 'business_bank_accounts')) {
                $table->enum('business_bank_accounts', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'accounts_notes_receivable')) {
                $table->enum('accounts_notes_receivable', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'investment_accounts')) {
                $table->enum('investment_accounts', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'digital_assets')) {
                $table->enum('digital_assets', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'available_credit')) {
                $table->enum('available_credit', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'owns_real_property')) {
                $table->enum('owns_real_property', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'real_property_for_sale')) {
                $table->enum('real_property_for_sale', ['unknown','no','yes'])->default('unknown');
            }

            if (!Schema::hasColumn('clients', 'listing_price')) {
                $table->string('listing_price')->nullable();
            }

            if (!Schema::hasColumn('clients', 'outside_us_assets')) {
                $table->enum('outside_us_assets', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'outside_us_assets_description')) {
                $table->text('outside_us_assets_description')->nullable();
            }

            if (!Schema::hasColumn('clients', 'vehicles_leased_purchased')) {
                $table->enum('vehicles_leased_purchased', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'business_tools_equipment')) {
                $table->enum('business_tools_equipment', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'intangible_assets')) {
                $table->enum('intangible_assets', ['unknown','no','yes'])->default('unknown');
            }
            if (!Schema::hasColumn('clients', 'business_liabilities')) {
                $table->enum('business_liabilities', ['unknown','no','yes'])->default('unknown');
            }
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'outside_us_6mos')) {
                $table->dropColumn('outside_us_6mos');
            }
            if (Schema::hasColumn('clients', 'enrolled_eftps')) {
                $table->dropColumn('enrolled_eftps');
            }
            if (Schema::hasColumn('clients', 'engage_ecommerce')) {
                $table->dropColumn('engage_ecommerce');
            }
            if (Schema::hasColumn('clients', 'accept_credit_cards')) {
                $table->dropColumn('accept_credit_cards');
            }
            if (Schema::hasColumn('clients', 'partners_officers')) {
                $table->dropColumn('partners_officers');
            }
            if (Schema::hasColumn('clients', 'other_business_affiliations')) {
                $table->dropColumn('other_business_affiliations');
            }
            if (Schema::hasColumn('clients', 'payroll_service_provider')) {
                $table->dropColumn('payroll_service_provider');
            }
            if (Schema::hasColumn('clients', 'related_parties_owe_business')) {
                $table->dropColumn('related_parties_owe_business');
            }
            if (Schema::hasColumn('clients', 'business_party_lawsuit')) {
                $table->dropColumn('business_party_lawsuit');
            }
            if (Schema::hasColumn('clients', 'taxpayer_party_lawsuit_irs')) {
                $table->dropColumn('taxpayer_party_lawsuit_irs');
            }
            if (Schema::hasColumn('clients', 'business_currently_bankrupt')) {
                $table->dropColumn('business_currently_bankrupt');
            }

            if (Schema::hasColumn('clients', 'business_ever_filed_bankruptcy')) {
                $table->dropColumn('business_ever_filed_bankruptcy');
            }
            if (Schema::hasColumn('clients', 'assets_transferred_less_value')) {
                $table->dropColumn('assets_transferred_less_value');
            }
            if (Schema::hasColumn('clients', 'real_estate_transferred_3yrs')) {
                $table->dropColumn('real_estate_transferred_3yrs');
            }
            if (Schema::hasColumn('clients', 'income_increase_decrease')) {
                $table->dropColumn('income_increase_decrease');
            }
            if (Schema::hasColumn('clients', 'safe_on_premises')) {
                $table->dropColumn('safe_on_premises');
            }
            // funds_held_in_trust comentado

            if (Schema::hasColumn('clients', 'business_bank_accounts')) {
                $table->dropColumn('business_bank_accounts');
            }
            if (Schema::hasColumn('clients', 'accounts_notes_receivable')) {
                $table->dropColumn('accounts_notes_receivable');
            }
            if (Schema::hasColumn('clients', 'investment_accounts')) {
                $table->dropColumn('investment_accounts');
            }
            if (Schema::hasColumn('clients', 'digital_assets')) {
                $table->dropColumn('digital_assets');
            }
            if (Schema::hasColumn('clients', 'available_credit')) {
                $table->dropColumn('available_credit');
            }
            if (Schema::hasColumn('clients', 'owns_real_property')) {
                $table->dropColumn('owns_real_property');
            }
            if (Schema::hasColumn('clients', 'real_property_for_sale')) {
                $table->dropColumn('real_property_for_sale');
            }

            if (Schema::hasColumn('clients', 'listing_price')) {
                $table->dropColumn('listing_price');
            }

            if (Schema::hasColumn('clients', 'outside_us_assets')) {
                $table->dropColumn('outside_us_assets');
            }
            if (Schema::hasColumn('clients', 'outside_us_assets_description')) {
                $table->dropColumn('outside_us_assets_description');
            }

            if (Schema::hasColumn('clients', 'vehicles_leased_purchased')) {
                $table->dropColumn('vehicles_leased_purchased');
            }
            if (Schema::hasColumn('clients', 'business_tools_equipment')) {
                $table->dropColumn('business_tools_equipment');
            }
            if (Schema::hasColumn('clients', 'intangible_assets')) {
                $table->dropColumn('intangible_assets');
            }
            if (Schema::hasColumn('clients', 'business_liabilities')) {
                $table->dropColumn('business_liabilities');
            }
        });
    }
};
