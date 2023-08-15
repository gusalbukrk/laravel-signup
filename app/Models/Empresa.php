<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends User
{
    protected $table = 'empresas';

    protected $fillable = ['razao_social', 'cnpj', 'nome_fantasia', 'telefone_comercial', 'numero', 'rua', 'bairro', 'cidade', 'estado', 'cep', 'complemento'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'subclass');
    }
}
