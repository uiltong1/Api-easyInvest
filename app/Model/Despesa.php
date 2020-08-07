<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $fillable = ['nmdespesa','valor','descricao','data'];
    protected $table ='despesa';

}
