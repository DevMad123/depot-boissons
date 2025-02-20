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
        Schema::create('traitement_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->on('produits')->onDelete('cascade');
            $table->unsignedBigInteger('tariftypeproduitclient_id');
            $table->foreign('tariftypeproduitclient_id')->references('id')->on('tariftypeproduitclients')->onDelete('cascade');
            $table->unsignedBigInteger('tariftypeproduitembclient_id')->nullable();
            $table->foreign('tariftypeproduitembclient_id')->references('id')->on('tariftypeproduitembclients')->onDelete('cascade');
            $table->integer('quantite'); // Quantité vendue
            $table->integer('quantite_emb_retour')->nullable(); // Quantité vendue
            $table->decimal('prix_vente_totalliquide', 15, 2)->default(0); // Prix total de la vente
            $table->decimal('prix_vente_totalemb', 15, 2)->default(0); // Prix total de la vente
            $table->date('date_vente')->default(now()); // Date de la vente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traitement_ventes');
    }
};
