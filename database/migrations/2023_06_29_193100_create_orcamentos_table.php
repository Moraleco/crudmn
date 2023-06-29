<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentosTable extends Migration
{
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->string('servicos', 200);
            $table->decimal('desconto', 10, 2);
            $table->decimal('frete', 10, 2);
            $table->decimal('outras_taxas', 10, 2);
            $table->string('forma_pagamento', 100);
            $table->text('informacoes_adicionais')->nullable();
            $table->decimal('valor_final', 10, 2);
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orcamentos');
    }
}
