<?php

// app/Models/Servico.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['orcamento_id', 'descricao', 'valor'];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class, 'orcamento_id'); // Garantindo chave estrangeira
    }
}
