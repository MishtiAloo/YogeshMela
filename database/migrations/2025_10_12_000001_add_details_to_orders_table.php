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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->default(0)->after('quantity');
            $table->decimal('additional_services_fee', 10, 2)->default(0)->after('total_price');
            $table->string('delivery_address')->nullable()->after('delivery_service');
            $table->string('phone')->nullable()->after('delivery_address');
            $table->string('payment_method')->default('cash')->after('phone');
            $table->text('notes')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'total_price',
                'additional_services_fee',
                'delivery_address',
                'phone',
                'payment_method',
                'notes',
            ]);
        });
    }
};
