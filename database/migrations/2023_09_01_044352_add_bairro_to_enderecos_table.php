<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBairroToEnderecosTable extends Migration
{
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('bairro', 100)->default('')->after('cidade');
            // Adiciona a coluna "bairro" após "cidade"
        });
    }

    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('bairro'); // Remove a coluna "bairro"
        });
    }
}
