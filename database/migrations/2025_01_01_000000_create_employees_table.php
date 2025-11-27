<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
        $table->string('name');
        $table->string('username');
        $table->string('email')->nullable();
        $table->string('phone', 20)->nullable();
        $table->string('designation')->nullable();
        $table->text('address')->nullable();
        $table->date('date')->nullable();      // New column
        $table->time('time')->nullable();      // New column
        $table->timestamps();
        
    });
}


    public function down()
{
    Schema::table('employees', function (Blueprint $table) {
        $table->dropColumn(['company_id', 'date', 'time']);
    });
}
}
