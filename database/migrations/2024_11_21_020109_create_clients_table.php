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
            $table->string('matriclient');
            $table->string('nom');
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->text('adresse')->nullable();
            $table->decimal('solde', 15, 2)->nullable(); // Solde des créances
            $table->boolean('exonerertva')->default(0);
            $table->boolean('exonererairsi')->default(0);
            $table->unsignedBigInteger('typeclient_id');
            $table->foreign('typeclient_id')->references('id')->on('typeclients')->onDelete('cascade');
            $table->string('image')->nullable();
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
