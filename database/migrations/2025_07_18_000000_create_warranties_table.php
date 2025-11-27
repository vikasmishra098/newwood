<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('pin');
            $table->string('dealer_name');
            $table->string('dealer_email');
            $table->string('dealer_phone');
            $table->text('dealer_address');
            $table->string('dealer_city');
            $table->string('dealer_state');
            $table->string('ppf_category');
            $table->string('chassis_no');
            $table->string('model');
            $table->string('year');
            $table->string('vehicle_number');
            $table->string('package');
            $table->string('warranty');
            $table->string('replacement_warranty');
            $table->string('validity');
            $table->date('date');
            $table->string('mobile_number');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};
