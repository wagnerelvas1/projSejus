<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{

        use HasFactory;

        protected $table = 'Enderecos';
        protected $fillable = [
            'id_endereco',
            'rua',
            'bairro',
            'cidade',
            'estado',
            'numero',
            'cep'
        ];
        public $timestamps = false;
        public function usuario()
    {
        return $this->hasOne(User::class, 'id_endereco', 'user_id');
    }
}
