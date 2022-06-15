<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use App\Models\Professor;
use Illuminate\Http\Request;

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
          'disciplinas' => auth()->guard('professor')->user()->pegarDisciplinas,
        ];
        return view('professores.index', compact('data'));
    }

    /**
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function alunosDisciplina(Disciplina $disciplina)
    {
        $data = [
          'disciplina'  => $disciplina,
          'alunos'      => $disciplina->pegarAlunos,
        ];
//        dd($data);
        return view('professores.alunos_disciplina', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editarAlunoDisciplina(Request $request)
    {
        try {
            $res = Disciplina::atualizarDadosDoAluno($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso');
        }
        catch (\Exception $exception){
            dd($exception->getMessage());
            return redirect(route('professor.home'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

}
