<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Remove a coluna 'servicos' da tabela 'orcamentos'
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn('servicos');
        });

        // Remove a coluna 'valor_do_servico' da tabela 'orcamentos'
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn('valor_do_servico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Reverte a remoção das colunas (opcional, apenas se necessário)
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->string('servicos', 200)->nullable(); // Adiciona a coluna 'servicos' novamente
            $table->decimal('valor_do_servico', 10, 2)->nullable(); // Adiciona a coluna 'valor_do_servico' novamente
        });
    }
};