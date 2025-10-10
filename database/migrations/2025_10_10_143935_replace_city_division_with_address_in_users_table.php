<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This migration ALTERs an existing table
        Schema::table('users', function (Blueprint $table) {
            // Drop the old columns
            $table->dropColumn(['city', 'division']);

            // Add the new combined address column
            $table->string('address')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        // Revert: Drop the new address column
        Schema::dropColumn('address'); // Use Schema::dropColumn on Blueprint instance
        
        // Revert: Re-add the old columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable()->after('phone');
            $table->string('division')->nullable()->after('city');
        });
    }
};