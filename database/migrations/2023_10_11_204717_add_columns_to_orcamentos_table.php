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
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->decimal('valor_do_servico', 10, 2);
            $table->string('status', 100);
            $table->string('situacao_pagamento', 100);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn('valor_do_servico');
            $table->dropColumn('status');
            $table->dropColumn('situacao_pagamento');
        });
    }
    
};
