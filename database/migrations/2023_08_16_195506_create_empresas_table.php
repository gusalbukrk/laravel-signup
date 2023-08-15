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
        Schema::create('empresas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('razao_social', 255)->unique();
            $table->char('cnpj', 14)->unique();
            $table->string('nome_fantasia', 255)->nullable();
            $table->char('telefone_comercial', 10)->unique()->nullable();

            // endereço
            $table->unsignedSmallInteger('numero');
            $table->string('rua', 120);
            $table->string('bairro', 60);
            $table->string('cidade', 40);
            $table->string('estado', 25);
            $table->char('cep', 8);
            $table->string('complemento', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
