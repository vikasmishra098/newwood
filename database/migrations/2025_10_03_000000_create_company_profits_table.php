<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profits', function (Blueprint $table) {
            $table->id();
            $table->decimal('profit_amount', 10, 2);
            $table->decimal('loss_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profits');
    }
};
