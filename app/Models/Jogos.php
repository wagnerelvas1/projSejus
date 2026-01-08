<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Jogos extends Model
{
    protected $table = 'Jogos';
    protected $primaryKey = 'id_jogo';
    public $timestamps = false;

    protected $fillable = [
        'nome_jogo',
        'plataforma',
        'valor',
        'discount',
        'description',
        'image_path'
    ];

    public function getFinalPriceAttribute()
    {
        if ($this->discount) {
            return $this->valor - ($this->valor * $this->discount /100);
        }
        return $this->valor;
    }

    public function getJogos()
    {
        return $this->select('j.*')
        ->get();
    }

    public function JogosGenero()
    {
        return $this->hasMany(Jogo_genero::class, 'fk_jogo_genero_to_jogos', 'id_jogo');
    }
    public function Wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_jogo');
    }
    public function carrinho()
    {
        return $this->hasMany(Carrinho::class, 'id_jogo');
    }
}
