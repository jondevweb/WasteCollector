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
        Schema::create('passages', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_debut_passage');
            $table->foreignId('collecte_id')->constrained();
            $table->foreignId('transporteur_id')->constrained();
            $table->dateTime('date_fin_passage');
            $table->boolean('validation_transporteur_passage');
            $table->longText('commentaire_transporteur_passage');
            $table->string('photo_transporteur_passage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passages');
    }
};
