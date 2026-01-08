<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jogos;

class Meus_Jogos extends Model
{
    protected $table = 'Meus_Jogos';
    protected $primaryKey = 'id_meus_jogos';
    public $timestamps = false;

    protected $fillable = [
        'fk_meus_jogos_to_user',
        'fk_meus_jogos_to_jogos',
    ];

    public function getJogosByUserId(int $id)
    {
        return $this->select('j.*')
        ->leftJoin('Jogos AS j', 'fk_meus_jogos_to_jogos', 'j.id_jogo')
        ->where('fk_meus_jogos_to_user', $id)
        ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_meus_jogos_to_user', 'user_id');
    }
    public function jogo()
    {
        return $this->belongsTo(Jogos::class, 'fk_meus_jogos_to_jogos', 'id_jogo');
    }
}
