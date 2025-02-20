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
        Schema::create('param_modepaiements', function (Blueprint $table) {
            $table->id();
            $table->string('mode_paiement')->unique(); // mode paiement : espèce, wave money, orange money etc
            $table->string('categorie')->nullable(); // paiement espèce, electronique, mobile
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_modepaiements');
    }
};
