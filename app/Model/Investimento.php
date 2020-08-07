<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Investimento extends Model
{
    protected $table = 'investimento';
    protected $fillable = ['nminvestimento','descricao','valor','data'];
}
