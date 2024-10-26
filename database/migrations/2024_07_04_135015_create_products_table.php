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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->integer('brand_id');
            $table->integer('unit_id');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->float('sale_price');
            $table->string('discount_type')->nullable();
            $table->float('discount_price')->nullable();
            $table->integer('quantity');
            $table->longText('product_description');
            $table->string('product_image');
            $table->string('product_gallery')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=yes, 0=no');
            $table->tinyInteger('is_featured')->default(0)->comment('1=yes, 0=no');
            $table->tinyInteger('is_todays_deal')->default(0)->comment('1=yes, 0=no');

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            // Indexes
            $table->index('category_id');
            $table->index('subcategory_id');
            $table->index('product_slug');
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_todays_deal');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
