<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Professor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'professores';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
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

    public function Disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(Disciplina::class, 'professor_disciplina', 'professor_id', 'disciplina_id');
    }

    public function getPegarDisciplinasAttribute(): array
    {
        $query = "select *
                    from professor_disciplina_view
                        where professor_id = :professor_id";
        return DB::select($query, ["professor_id" => auth()->guard('professor')->user()->id]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novoProfessor(array $dados)
    {
        return DB::select("call cadastrar_professor(
            :nome,
            :cpf,
            :telefone,
            :email,
            :senha
        )",[
            'nome'                  => $dados['nome'],
            'cpf'                   => $dados['cpf'],
            'telefone'              => $dados['telefone'],
            'email'                 => $dados['email'],
            'senha'                 => Hash::make($dados['cpf'])
        ]);
    }

    public function atualizarProfessor(Professor $professor, array $dados)
    {
        return DB::select("call atualizar_professor(
            :id,
            :nome,
            :telefone
        )",[
            'id'                    => $professor->id,
            'nome'                  => $dados['nome'],
            'telefone'              => $dados['telefone'],
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function novaDisciplinaProfessor(array $dados)
    {
        return DB::select("call cadastrar_professor_disciplina(
            :professor_id,
            :disciplina_id
        )",[
            'professor_id'    => $dados['professor_id'],
            'disciplina_id'   => $dados['disciplina_id'],
        ]);
    }

    /**
     * @param array $dados
     * @return array
     */
    public function deletarDisciplinaProfessor(array $dados)
    {
        return DB::select("call deletar_professor_disciplina(
            :professor_id,
            :disciplina_id
        )",[
            'professor_id'    => $dados['professor_id'],
            'disciplina_id'   => $dados['disciplina_id'],
        ]);
    }

}
