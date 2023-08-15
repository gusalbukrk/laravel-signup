<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends User
{
    protected $table = 'clientes';

    protected $fillable = ['inscricao_estadual', 'is_pessoa_fisica', 'nome', 'cpf', 'razao_social', 'cnpj'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'subclass');
    }
}
