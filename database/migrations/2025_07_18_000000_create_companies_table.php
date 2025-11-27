<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
{
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('customer_name');
        $table->string('comservicehidden');
        $table->string('customer_phone');
        $table->string('cosmachinename');
        $table->string('cos_address');
        $table->string('cosmachinedetail');
        $table->string('cosspareparts');
        $table->string('cossparepartsrequired');
        $table->string('cosstatus');
        $table->timestamps();
    });
}


};
