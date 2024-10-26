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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('division_id');
            $table->string('district_id');
            $table->string('Thana_id');
            $table->string('union_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('info_id')->comment('User ID or Session ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
