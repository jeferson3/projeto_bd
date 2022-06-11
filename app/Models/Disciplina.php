<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'pre_requisito_id'
    ];

    public function Alunos(): BelongsToMany
    {
        return $this->belongsToMany(Aluno::class, 'aluno_disciplina', 'disciplina_id', 'aluno_id')
                    ->withPivot('status', 'frequencia', 'nota_bimestre1', 'nota_bimestre2');
    }

    public function Cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'curso_disciplina', 'disciplina_id', 'curso_id')
            ->withPivot('carga_horaria');
    }

    public function Professores(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class, 'professor_disciplina', 'disciplina_id', 'professor_id');
    }

}
