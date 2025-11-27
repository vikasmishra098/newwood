<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->string('qname');
            $table->string('qemail');
            $table->string('qphone'); 
            $table->string('qcar');
            $table->text('qcomment')->nullable(); 
            $table->string('qfollow')->nullable(); 
            $table->enum('qpriority', ['Low', 'Medium', 'High'])->default('Medium'); 
            $table->enum('qstatus', ['Open', 'In Progress', 'Closed'])->default('Open'); 
            $table->json('qtimeline')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
