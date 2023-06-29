<?php

// app/Models/Peca.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    protected $fillable = ['orcamento_id', 'nome', 'preco'];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }
}
