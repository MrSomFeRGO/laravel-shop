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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreignId('user_address_id')
                ->references('id')
                ->on('user_addresses');
            $table->unsignedDecimal('total_price', 16);
            $table->string('status');
            $table->string('payment_method');
            $table->string('current_account')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bik')->nullable();
            $table->string('unp')->nullable();
            $table->string('okpo')->nullable();
            $table->string('doc_url')->nullable();
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
