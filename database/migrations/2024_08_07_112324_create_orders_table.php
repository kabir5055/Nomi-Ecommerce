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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('info_id')->comment('User ID or Session ID');
            $table->string('order_no');
            $table->float('grand_total');
            $table->float('subtotal_amount');
            $table->float('shipping_charge')->nullable();
            $table->float('coupon_amount')->nullable();
            $table->string('delivery_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
