<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Professor;

class ProfessorController extends Controller
{

    private Professor $modelProfessor;

    public function __construct(Professor $aluno)
    {
        $this->modelProfessor = $aluno;
        $this->middleware('authProfessor');
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
        return view('professores.index', compact('data'));
    }
}
