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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('tax_id', 15)->nullable();
            $table->string('foreign_tax_id', 15)->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('accounting_code', 10)->nullable();
            $table->boolean('billing_by_ref')->default(false);

            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->foreignId('payment_term_id')->constrained()->restrictOnDelete();
            $table->foreignId('client_group_id')->constrained()->restrictOnDelete();
            $table->foreignId('sales_rep_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
