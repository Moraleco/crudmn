<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePecasTable extends Migration
{
    public function up()
    {
        Schema::create('pecas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orcamento_id');
            $table->string('nome', 100);
            $table->decimal('preco', 10, 2);
            $table->timestamps();

            $table->foreign('orcamento_id')->references('id')->on('orcamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pecas');
    }
}
