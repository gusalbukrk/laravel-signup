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
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('inscricao_estadual', 10)->unique();

            // using Table per Hierarchy (TPH) to represent in a single table
            // both clientes pessoas físicas e clientes pessoas jurídicas
            $table->boolean('is_pessoa_fisica');
            $table->string('nome', 255)->nullable();
            $table->char('cpf', 11)->unique()->nullable();
            $table->string('razao_social', 255)->nullable();
            $table->char('cnpj', 14)->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
