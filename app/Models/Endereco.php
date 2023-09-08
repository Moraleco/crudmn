<?php

// app/Models/Endereco.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['cliente_id', 'logradouro', 'numero', 'cidade', 'estado', 'cep', 'bairro'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
