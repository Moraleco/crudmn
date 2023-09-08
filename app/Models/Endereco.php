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

    public function setCepAttribute($value){
        
        return $this->attributes['cep'] = preg_replace('/[^0-9]/','', $value);


    }

}
