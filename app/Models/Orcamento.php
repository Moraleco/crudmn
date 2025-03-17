<?php

// app/Models/Orcamento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = [
        'cliente_id', 'desconto', 'frete', 'outras_taxas', 'forma_pagamento',
        'status', 'situacao_pagamento', 'informacoes_adicionais', 'valor_final',
      
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'orcamento_id'); // Garantindo chave estrangeira correta
    }
}
