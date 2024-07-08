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
        Schema::create('collectes_dechets_lines', function (Blueprint $table) {
            $table->foreignId('collecte_id')->constrained();
            $table->foreignId('dechet_id')->constrained();
            $table->double('poid_collecte_dechet_line');
            $table->timestamps();
            
            $table->primary(['collecte_id', 'dechet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collectes_dechets_lines');
    }
};
