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
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tariftypeproduitfournisseur_id');
            $table->foreign('tariftypeproduitfournisseur_id')->references('id')->on('tariftypeproduitfournisseurs')->onDelete('cascade');
            $table->integer('quantite');
            $table->date('date_approvisionnement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvisionnements');
    }
};
