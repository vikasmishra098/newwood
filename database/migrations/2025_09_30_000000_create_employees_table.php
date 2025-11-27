<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            // Link to users table (customer)
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            
            // Link to companies table (optional)
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('designation')->nullable();
            $table->text('address')->nullable();
            
            // Date and time columns
            $table->date('date')->nullable();
            $table->time('time')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
