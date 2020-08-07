<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nmpessoa', 'cpf', 'idade','sexo', 'telefone', 'rg'
    ];
}
