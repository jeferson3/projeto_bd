<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    /**
     * @return array
     */
    function getPegarDadosAttribute(): array
    {
        $query = "select *, media_aluno_disciplina(nota_bimestre1, nota_bimestre2) media
                    from aluno_disciplina_view
                        where aluno_id = :aluno_id";
        return DB::select($query, ["aluno_id" => auth()->user()->id]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novoAluno(array $dados)
    {
        return DB::select("call cadastrar_aluno(
            :nome,
            :data_nascimento,
            :cpf,
            :rg,
            :telefone,
            :curso_id,
            :email,
            :senha
        )",[
            'nome'                  => $dados['nome'],
            'data_nascimento'       => $dados['data_nascimento'],
            'cpf'                   => $dados['cpf'],
            'rg'                    => $dados['rg'],
            'telefone'              => $dados['telefone'],
            'curso_id'              => $dados['curso_id'],
            'email'                 => $dados['email'],
            'senha'                 => Hash::make($dados['cpf'])
        ]);
    }

    public function atualizarAluno(Aluno $aluno, array $dados)
    {
        return DB::select("call atualizar_aluno(
            :id,
            :nome,
            :data_nascimento,
            :telefone,
            :email
        )",[
            'id'                    => $aluno->id,
            'nome'                  => $dados['nome'],
            'data_nascimento'       => $dados['data_nascimento'],
            'telefone'              => $dados['telefone'],
            'email'                 => $aluno->email,
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novaDisciplinaAluno(array $dados)
    {
        return DB::select("call cadastrar_aluno_disciplina(
            :aluno_id,
            :disciplina_id,
            :status,
            :frequencia
        )",[
            'aluno_id'        => $dados['aluno_id'],
            'disciplina_id'   => $dados['disciplina_id'],
            'status'          => 'cursando',
            'frequencia'      => 100,
        ]);
    }


    /**
     * @param array $dados
     * @return array
     */
    public static function atualizarDisciplinaAluno(array $dados): array
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
            "aluno_id"          => $dados['aluno_id'],
            "disciplina_id"     => $dados['disciplina_id'],
            "status"            => $dados['status'],
            "frequencia"        => $dados['frequencia'],
            "nota_bimestre1"    => $dados['nota_bimestre1'],
            "nota_bimestre2"    => $dados['nota_bimestre2']
        ]);
    }

}
