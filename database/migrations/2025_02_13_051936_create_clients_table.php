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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('mi')->nullable();
            $table->string('last_name')->nullable();
            $table->string('ssn')->nullable();
            $table->date('date_birdth')->nullable();
            $table->string('dl')->nullable();
            $table->string('dl_state')->nullable();
            $table->string('has_passport')->nullable();
            $table->string('client_reference')->nullable();
            $table->longText('saludation_for_letter')->nullable();
            $table->enum("type_address", ["1", "2"])->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();

            $table->string('m_address_1')->nullable();
            $table->string('m_address_2')->nullable();
            $table->string('m_city')->nullable();
            $table->string('m_state')->nullable();
            $table->string('m_zipcode')->nullable();

            $table->enum("marital_status", ["1", "2"])->nullable();
            $table->date('marital_date')->nullable();

            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_mi')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('spouse_ssn')->nullable();
            $table->date('spouse_date_birdth')->nullable();
            $table->string('spouse_dl')->nullable();
            $table->string('spouse_dl_state')->nullable();
            $table->string('spouse_has_passport')->nullable();
            $table->longText('spouse_saludation_for_letter')->nullable();

            $table->string('phone_home')->nullable();
            $table->string('cell_home')->nullable();
            $table->string('fax_home')->nullable();

            $table->string('phone_work')->nullable();
            $table->string('cell_work')->nullable();
            $table->string('fax_work')->nullable();

            $table->string('spouse_phone_home')->nullable();
            $table->string('spouse_cell_home')->nullable();
            $table->string('spouse_fax_home')->nullable();

            $table->string('spouse_phone_work')->nullable();
            $table->string('spouse_cell_work')->nullable();
            $table->string('spouse_fax_work')->nullable();

            $table->string('tax_payer_email')->nullable();
            $table->string('spouse_email')->nullable();
            $table->boolean('estatus')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
