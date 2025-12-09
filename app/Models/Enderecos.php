<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $primaryKey = 'id_endereco';
    public $timestamps = false;

        use HasFactory;

        protected $table = 'Enderecos';
        protected $fillable = [
            'rua',
            'bairro',
            'cidade',
            'estado',
            'numero',
            'cep'
        ];
        public function usuario()
    {
        return $this->hasOne(User::class, 'id_endereco', 'id_endereco');
    }
}
