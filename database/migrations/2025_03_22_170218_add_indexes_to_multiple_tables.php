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
        Schema::table('users', function (Blueprint $table) {
            $table->index('company_id'); // Índice normal
            // $table->unique('email'); // Índice único
        });

        // Agregar índices a la tabla clients
        Schema::table('clients', function (Blueprint $table) {
            $table->index(['company_id', 'form_type', 'estatus', 'case_status']); // Índice compuesto
        });

        Schema::table('dependents', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('employment', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('employment_spouse', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('business_interests', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('lawsuits', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('lawsuits_irs', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('bankruptcies', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('beneficiaries_insurance', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('trustees', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('trust_funds', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('safe_deposit_boxes', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('lived_abroad', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('assets_abroad', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('investment_accounts', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('digital_assets', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('retirement_accounts', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('credit_accounts', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('life_insurances', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('asset_transfers', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('real_estate_transfers', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('type_residences', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('property_sales', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('vehicles', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        Schema::table('other_assets', function (Blueprint $table) {
            $table->index(['client_id']); // Índice unico
        });
        // Schema::table('pay_periods', function (Blueprint $table) {
        //     $table->index(['client_id']); // Índice unico
        // });
        //Schema::table('bank_account_types', function (Blueprint $table) {
           // $table->index(['client_id']); // Índice unico
        //});
        //Schema::table('business_types', function (Blueprint $table) {
           // $table->index(['client_id']); // Índice unico
        //});
        Schema::table('payment_processors', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('credit_cards', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('business_bank_accounts', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('company_bank_accounts', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('company_digital_assets', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('company_accounts_receivable', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('company_tools_equipment', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('company_intangible_assets', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('income_expense_periods', function (Blueprint $table) {
            $table->index('client_id');
        });

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
