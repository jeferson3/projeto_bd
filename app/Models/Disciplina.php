<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'pre_requisito_id'
    ];

    public function PreRequisito()
    {
        return $this->belongsTo(Disciplina::class, 'pre_requisito_id');
    }

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

    /**
     * @return array
     */
    public function getPegarAlunosAttribute(): array
    {
        $query = "select *, media_aluno_disciplina(nota_bimestre1, nota_bimestre2) media
                    from aluno_disciplina_view
                        where disciplina_pk_id = :disciplina_id";
        return DB::select($query, ["disciplina_id" => $this->id]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public static function atualizarDadosDoAluno(array $dados): array
    {
        $query = "call atualizar_aluno_disciplina(
                    :aluno_id,
                    :disciplina_id,
                    :status,
                    :frequencia,
                    :nota_bimestre1,
                    :nota_bimestre2
                )";
        return DB::select($query, [
            "aluno_id"          => $dados['aluno'],
            "disciplina_id"     => $dados['disciplina'],
            "status"            => $dados['status'],
            "frequencia"        => $dados['frequencia'],
            "nota_bimestre1"    => $dados['nota_bimestre1'],
            "nota_bimestre2"    => $dados['nota_bimestre2']
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novaDisciplina(array $dados)
    {
        return DB::select("call cadastrar_disciplina(
            :nome,
            :pre_requisito_id
        )",[
            'nome'              => $dados['nome'],
            'pre_requisito_id'  => $dados['pre_requisito_id'] ?? null
        ]);
    }

    public function atualizarDisciplina(Disciplina $disciplina, array $dados)
    {
        return DB::select("call atualizar_disciplina(
            :id,
            :nome,
            :pre_requisito_id
        )",[
            'id'                => $disciplina->id,
            'nome'              => $dados['nome'],
            'pre_requisito_id'  => $dados['pre_requisito_id'] ?? null
        ]);
    }

}
