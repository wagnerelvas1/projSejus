<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'Usuarios';

    protected $fillable = [
        'id_usuario',
        'nome',
        'data_nascimento',
        'email',
        'cpf',
        'senha',
        'id_endereco',
        'id_meus_jogos',
        'id_wishlist'
    ];

    public $timestamps = false;
    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'id_endereco');
        return $this->hasONe(Meus_Jogos::class, 'id_meus_jogos');
    }
}
