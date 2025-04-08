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
        Schema::create('journeeoperations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journee_id');
            $table->unsignedBigInteger('produit_id');
            $table->enum('type_operation', ['vente', 'approvisionnement'])->default('vente');
            $table->integer('quantite');
            $table->decimal('montant', 15, 2);
            $table->timestamps();
            $table->foreign('journee_id')->references('id')->on('journee')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journeeoperations');
    }
};
