<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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

}
