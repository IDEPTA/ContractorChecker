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
        Schema::create('counterparties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('inn')->unique();
            $table->string('ogrn')->nullable();
            $table->string('kpp')->nullable();
            $table->string('full_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('status')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('liquidation_date')->nullable();
            $table->string('address')->nullable();
            $table->string('okved_main_code')->nullable();
            $table->string('okved_main_name')->nullable();
            $table->integer('employees_count')->nullable();
            $table->json('founders')->nullable();
            $table->json('managers')->nullable();
            $table->json('okveds')->nullable();
            $table->json('phones')->nullable();
            $table->json('emails')->nullable();
            $table->json('websites')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counterparties');
    }
};
