<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('service_requests', function (Blueprint $table) {
        $table->id();
        $table->string('service_name');
        $table->string('service_email');
        $table->string('service_phone');
        $table->string('service_requirement');
        $table->json('service_check')->nullable(); // if you're saving checkbox values
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
}
