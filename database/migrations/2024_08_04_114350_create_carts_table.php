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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('info_id')->nullable()->comment('User ID or Session ID');
            $table->integer('product_id');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->float('sale_price');
            $table->integer('quantity');
            $table->float('unit_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
