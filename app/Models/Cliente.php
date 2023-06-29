<?php

// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'telefone', 'documento', 'endereco'];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }
}
