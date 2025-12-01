<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generos extends Model
{
    protected $table = 'Generos';

    protected $fillable = [
        'id_genero',
        'nome_genero'
    ];

    public $timestamps = false;
}
