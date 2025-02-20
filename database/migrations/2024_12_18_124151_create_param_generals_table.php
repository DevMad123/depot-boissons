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
        Schema::create('param_generals', function (Blueprint $table) {
            $table->id();
            $table->string('Nom_entreprise'); // 
            $table->string('email')->nullable(); // Email
            $table->string('phone')->nullable(); // Téléphone
            $table->string('address')->nullable(); // Adresse
            $table->string('product_image')->nullable(); // Image du produit (peut être nulle)
            $table->unsignedBigInteger('devise_id');
            $table->timestamps(); // timestamps (created_at, updated_at)
            $table->foreign('devise_id')->references('id')->on('devises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_generals');
    }
};
