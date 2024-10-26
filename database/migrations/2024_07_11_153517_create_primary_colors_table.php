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
        Schema::create('primary_colors', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color')->default('#3490dc');
            $table->string('secondary_color')->default('#6cb2eb'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_colors');
    }
};
