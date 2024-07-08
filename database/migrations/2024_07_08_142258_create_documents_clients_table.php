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
        Schema::create('documents_clients', function (Blueprint $table) {
            $table->string('name_document_client', length: 60)->primary();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('document_type_id')->constrained();
            $table->binary('pdf_document_client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_clients');
    }
};
