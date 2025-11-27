<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table (employee)
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to companies table
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            // Visit details
            $table->string('machine_name');
            $table->date('date');
            $table->text('add_parts')->nullable();
            $table->text('required_parts')->nullable();
            $table->text('receive_parts')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('who_solve')->nullable();
            $table->text('problem');
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
