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
        Schema::create('listeventes', function (Blueprint $table) {
            $table->id();
            $table->string('code_vente');
            $table->string('facture_num');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->decimal('montant_totalhtliquide', 15, 2); // Montant total de la facture
            $table->decimal('montant_totalhtemballage', 15, 2); // Montant total de la facture
            $table->unsignedBigInteger('tva_id');
            $table->foreign('tva_id')->references('id')->on('tvas')->onDelete('cascade');
            $table->unsignedBigInteger('fraisairsi_id');
            $table->foreign('fraisairsi_id')->references('id')->on('fraisairsis')->onDelete('cascade');
            $table->unsignedBigInteger('parammodepaiement_id');
            $table->foreign('parammodepaiement_id')->references('id')->on('param_modepaiements')->onDelete('cascade');
            $table->string('num_paiement')->nullable();
            $table->string('code_reference')->nullable();
            $table->string('espece_receptionne')->nullable();
            $table->string('fraisport')->nullable();
            $table->text('notes')->nullable(); 
            $table->enum('validervente', ['encours', 'valider', 'annuler'])->default('encours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listeventes');
    }
};
