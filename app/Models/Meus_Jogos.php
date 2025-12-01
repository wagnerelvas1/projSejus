<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meus_Jogos extends Model
{
    protected $table = 'Meus_Jogos';

    protected $fillable = [
        'id_meus_jogos',
        'id_usuario',
        'id_jogo',
    ];

    public $timestamps = false;

    public function Meus_Jogos()
    {
        return $this->hasMany(Jogos::class, 'id_jogo');
        return $this->hasOne(Usuarios::class, 'id_usuario');
    }
}
