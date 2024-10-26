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
        Schema::create('free_shipping_limits', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2)->default(0);
            $table->text('description');
            $table->tinyInteger('status')->default(0)->comment('1=active, 0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_shipping_limits');
    }
};
