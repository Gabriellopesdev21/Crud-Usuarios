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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna FK como nullable (um usuário pode não ter endereço ainda)
            $table->unsignedBigInteger('end_id')
                  ->nullable() // IMPORTANTE: permite NULL
                  ->constrained('enderecos') // Referencia a tabela 'endereco'
                  ->onDelete('set null'); // Se endereço for deletado, seta como NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['end_ind']);
            $table->dropColumn(['end_ind']);
        });
    }
};
