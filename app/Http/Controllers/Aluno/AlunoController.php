<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno;

class AlunoController extends Controller
{

    private Aluno $modelAluno;

    public function __construct(Aluno $aluno)
    {
        $this->modelAluno = $aluno;
        $this->middleware('authAluno');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
          'curso'       => auth()->user()->Curso,
          'disciplinas' => auth()->user()->pegarDados,
        ];
        return view('alunos.index', compact('data'));
    }
}
