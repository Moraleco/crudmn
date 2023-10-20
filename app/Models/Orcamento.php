<?php

// app/Models/Orcamento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = ['cliente_id', 'servicos', 'desconto', 'frete', 'outras_taxas', 'forma_pagamento','status','situacao_pagamento', 'informacoes_adicionais','valor_do_servico', 'valor_final'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pecas()
    {
        return $this->hasMany(Peca::class);
    }
}
