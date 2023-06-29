<?php

// app/Models/Endereco.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['logradouro', 'numero', 'cidade', 'estado', 'cep'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
