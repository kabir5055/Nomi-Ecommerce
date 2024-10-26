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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_type');
            $table->string('banner_title')->nullable();
            $table->string('banner_image');
            $table->string('banner_link')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');

            // ইনডেক্স যোগ করা
            $table->index('banner_type');
            $table->index('banner_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
