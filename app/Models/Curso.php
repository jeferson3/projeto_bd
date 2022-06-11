<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo'
    ];

    public $timestamps = false;

    public function Alunos(): HasMany
    {
        return $this->hasMany(Aluno::class, 'curso_id');
    }

    public function Disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(Disciplina::class, 'curso_disciplina', 'curso_id', 'disciplina_id')
            ->withPivot('carga_horaria');
    }

}
