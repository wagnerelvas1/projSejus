<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Carrinho extends Model
{
    protected $table = 'Carrinho';
    protected $primaryKey = 'carrinho_id';

    protected $fillable = [
        'car_id',
        'fk_carrinho_to_user',
        'fk_carrinho_to_jogos'
    ];

     public function getJogosByUserId(int $id)
    {
        return $this->select('j.*')
        ->leftJoin('Jogos AS j', 'fk_carrinho_to_jogos', 'j.id_jogo')
        ->where('fk_carrinho_to_user', $id)
        ->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_carrinho_to_user', 'user_id');
    }
    public function jogo()
    {
        return $this->belongsTo(Jogos::class, 'fk_carrinho_to_jogos', 'id_jogo');
    }
}
