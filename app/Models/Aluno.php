<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'data_nascimento',
        'nome',
        'cpf',
        'rg',
        'telefone',
        'curso_id',
        'email',
        'senha'
    ];

    protected $hidden = [
        'senha'
    ];

    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->attributes['senha'];
    }

    public function Curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function Disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(Disciplina::class, 'aluno_disciplina', 'aluno_id', 'disciplina_id')
            ->withPivot('status', 'frequencia', 'nota_bimestre1', 'nota_bimestre2');
    }

}
