<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orcamento_id'); // Chave estrangeira para 'orcamentos'
            $table->string('descricao', 200); // Descrição do serviço
            $table->decimal('valor', 10, 2); // Valor do serviço
            $table->timestamps();

            // Define a chave estrangeira
            $table->foreign('orcamento_id')->references('id')->on('orcamentos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}