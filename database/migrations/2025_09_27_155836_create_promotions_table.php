<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->decimal('amount_paid', 10,2);
            $table->decimal('fixed_discount', 10, 2)->nullable();
            $table->decimal('percent_discount', 10, 2)->nullable();
            $table->enum('status', ['pending', 'active', 'expired'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
