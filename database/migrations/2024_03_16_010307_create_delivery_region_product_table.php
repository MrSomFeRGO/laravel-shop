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
        Schema::create('delivery_region_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_region_id')->references('id')
                ->on('delivery_regions')->cascadeOnDelete();
            $table->foreignId('product_id')->references('id')
                ->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_region_product');
    }
};
