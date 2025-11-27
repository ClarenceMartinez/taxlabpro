<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states_of_america', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('abrev', 2)->unique();
            $table->string('zipcode', 10);
            $table->timestamps();
        });

        DB::table('states_of_america')->insert([
            ['name' => 'Alabama', 'abrev' => 'AL', 'zipcode' => '35004'],
            ['name' => 'Alaska', 'abrev' => 'AK', 'zipcode' => '99501'],
            ['name' => 'Arizona', 'abrev' => 'AZ', 'zipcode' => '85001'],
            ['name' => 'Arkansas', 'abrev' => 'AR', 'zipcode' => '72201'],
            ['name' => 'California', 'abrev' => 'CA', 'zipcode' => '90001'],
            ['name' => 'Colorado', 'abrev' => 'CO', 'zipcode' => '80001'],
            ['name' => 'Connecticut', 'abrev' => 'CT', 'zipcode' => '06001'],
            ['name' => 'Delaware', 'abrev' => 'DE', 'zipcode' => '19901'],
            ['name' => 'Florida', 'abrev' => 'FL', 'zipcode' => '32003'],
            ['name' => 'Georgia', 'abrev' => 'GA', 'zipcode' => '30301'],
            ['name' => 'Hawaii', 'abrev' => 'HI', 'zipcode' => '96701'],
            ['name' => 'Idaho', 'abrev' => 'ID', 'zipcode' => '83201'],
            ['name' => 'Illinois', 'abrev' => 'IL', 'zipcode' => '60001'],
            ['name' => 'Indiana', 'abrev' => 'IN', 'zipcode' => '46001'],
            ['name' => 'Iowa', 'abrev' => 'IA', 'zipcode' => '50001'],
            ['name' => 'Kansas', 'abrev' => 'KS', 'zipcode' => '66002'],
            ['name' => 'Kentucky', 'abrev' => 'KY', 'zipcode' => '40003'],
            ['name' => 'Louisiana', 'abrev' => 'LA', 'zipcode' => '70001'],
            ['name' => 'Maine', 'abrev' => 'ME', 'zipcode' => '03901'],
            ['name' => 'Maryland', 'abrev' => 'MD', 'zipcode' => '20601'],
            ['name' => 'Massachusetts', 'abrev' => 'MA', 'zipcode' => '01001'],
            ['name' => 'Michigan', 'abrev' => 'MI', 'zipcode' => '48001'],
            ['name' => 'Minnesota', 'abrev' => 'MN', 'zipcode' => '55001'],
            ['name' => 'Mississippi', 'abrev' => 'MS', 'zipcode' => '38601'],
            ['name' => 'Missouri', 'abrev' => 'MO', 'zipcode' => '63001'],
            ['name' => 'Montana', 'abrev' => 'MT', 'zipcode' => '59001'],
            ['name' => 'Nebraska', 'abrev' => 'NE', 'zipcode' => '68001'],
            ['name' => 'Nevada', 'abrev' => 'NV', 'zipcode' => '88901'],
            ['name' => 'New Hampshire', 'abrev' => 'NH', 'zipcode' => '03031'],
            ['name' => 'New Jersey', 'abrev' => 'NJ', 'zipcode' => '07001'],
            ['name' => 'New Mexico', 'abrev' => 'NM', 'zipcode' => '87001'],
            ['name' => 'New York', 'abrev' => 'NY', 'zipcode' => '10001'],
            ['name' => 'North Carolina', 'abrev' => 'NC', 'zipcode' => '27006'],
            ['name' => 'North Dakota', 'abrev' => 'ND', 'zipcode' => '58001'],
            ['name' => 'Ohio', 'abrev' => 'OH', 'zipcode' => '43001'],
            ['name' => 'Oklahoma', 'abrev' => 'OK', 'zipcode' => '73001'],
            ['name' => 'Oregon', 'abrev' => 'OR', 'zipcode' => '97001'],
            ['name' => 'Pennsylvania', 'abrev' => 'PA', 'zipcode' => '15001'],
            ['name' => 'Rhode Island', 'abrev' => 'RI', 'zipcode' => '02801'],
            ['name' => 'South Carolina', 'abrev' => 'SC', 'zipcode' => '29001'],
            ['name' => 'South Dakota', 'abrev' => 'SD', 'zipcode' => '57001'],
            ['name' => 'Tennessee', 'abrev' => 'TN', 'zipcode' => '37010'],
            ['name' => 'Texas', 'abrev' => 'TX', 'zipcode' => '73301'],
            ['name' => 'Utah', 'abrev' => 'UT', 'zipcode' => '84001'],
            ['name' => 'Vermont', 'abrev' => 'VT', 'zipcode' => '05001'],
            ['name' => 'Virginia', 'abrev' => 'VA', 'zipcode' => '20101'],
            ['name' => 'Washington', 'abrev' => 'WA', 'zipcode' => '98001'],
            ['name' => 'West Virginia', 'abrev' => 'WV', 'zipcode' => '24701'],
            ['name' => 'Wisconsin', 'abrev' => 'WI', 'zipcode' => '53001'],
            ['name' => 'Wyoming', 'abrev' => 'WY', 'zipcode' => '82001'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states_of_america');
    }
};
