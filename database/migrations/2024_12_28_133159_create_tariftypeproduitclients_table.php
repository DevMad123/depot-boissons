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
        Schema::create('tariftypeproduitclients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('typeclient_id');
            $table->foreign('typeclient_id')->references('id')->on('typeclients')->onDelete('cascade');
            $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');         
            $table->decimal('tarifliquide', 15, 2)->default(0); // tarif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariftypeproduitclients');
    }
};
