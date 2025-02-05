<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 400)
                ->unique();
            $table->longText('description')
                ->nullable();
            $table->string('certificate_url')
                ->nullable();
            $table->foreignId('standard_id')
                ->nullable()
                ->references('id')
                ->on('standards')
                ->nullOnDelete();
            $table->string('conformity_declaration')
                ->nullable();
            $table->unsignedDecimal('price');
            $table->string('price_units');
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
