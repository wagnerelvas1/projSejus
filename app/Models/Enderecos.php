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
            'numero',
            'cidade',
            'estado',
            'cep'
        ];
        public $timestamps = false;
        public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'id_endereco');
    }
}
