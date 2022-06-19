<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param array $dados
     * @return array
     */
    public function novoCurso(array $dados)
    {
        return DB::select("call cadastrar_curso(
            :nome,
            :tipo
        )",[
            'nome'  => $dados['nome'],
            'tipo'  => $dados['tipo']
        ]);
    }

    public function atualizarCurso(Curso $curso, array $dados)
    {
        return DB::select("call atualizar_curso(
            :id,
            :nome,
            :tipo
        )",[
            'id'    => $curso->id,
            'nome'  => $dados['nome'],
            'tipo'  => $dados['tipo']
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novaDisciplinaCurso(array $dados)
    {
        return DB::select("call cadastrar_curso_disciplina(
            :curso_id,
            :disciplina_id,
            :carga_horaria
        )",[
            'curso_id'        => $dados['curso_id'],
            'disciplina_id'   => $dados['disciplina_id'],
            'carga_horaria'   => $dados['carga_horaria'],
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function deletarDisciplinaCurso(array $dados)
    {
        return DB::select("call deletar_curso_disciplina(
            :curso_id,
            :disciplina_id
        )",[
            'curso_id'        => $dados['curso_id'],
            'disciplina_id'   => $dados['disciplina_id'],
        ]);
    }

}
