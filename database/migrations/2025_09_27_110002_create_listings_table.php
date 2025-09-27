<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // seller
            $table->enum('animal_type', ['cow','goat','sheep','camel']);
            $table->string('breed');
            $table->integer('age');
            $table->decimal('weight', 5, 2);
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->text('vaccination_info')->nullable();
            $table->enum('status', ['available','sold'])->default('available');
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
