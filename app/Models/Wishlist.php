<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'Wishlist';

    protected $fillable = [
        'id_wishlist',
        'id_usuario',
        'id_jogo',
    ];

    public $timestamps = false;

    public function wishlist()
    {
        return $this->hasMany(Jogos::class, 'id_jogo');
        return $this->hasOne(Usuarios::class, 'id_usuario');
    }
}
