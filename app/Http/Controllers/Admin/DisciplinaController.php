<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    private Disciplina $modelDisciplina;

    public function __construct(Disciplina $disciplina)
    {
        $this->modelDisciplina = $disciplina;
        $this->middleware('authAdmin');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'disciplinas' => $this->modelDisciplina->with('PreRequisito')->orderBy('id', 'desc')->get()
        ];
        return view('admins.disciplinas.index', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $res = $this->modelDisciplina->novaDisciplina($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados registrados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.disciplina.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Disciplina $disciplina)
    {
        try {
            $res = $this->modelDisciplina->atualizarDisciplina($disciplina, $request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.disciplina.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Disciplina $disciplina)
    {
        try {
            $res = $this->modelDisciplina->deletarDisciplina($disciplina);
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.disciplina.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cursosIndex(Request $request, Disciplina $disciplina)
    {
        $data = [
            'cursos'         => $disciplina->Cursos,
            'disciplina'     => $disciplina,
        ];
        return view('admins.disciplinas.cursos.index', compact('data'));
    }

    /**
     * @param Request $request
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alunosIndex(Request $request, Disciplina $disciplina)
    {
        $data = [
            'alunos'         => $disciplina->Alunos,
            'disciplina'     => $disciplina,
            'disciplinas'    => Disciplina::all()
        ];
        return view('admins.disciplinas.alunos.index', compact('data'));
    }

    /**
     * @param Request $request
     * @param Disciplina $disciplina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function professoresIndex(Request $request, Disciplina $disciplina)
    {
        $data = [
            'professores'    => $disciplina->Professores,
            'disciplina'     => $disciplina
        ];
        return view('admins.disciplinas.professores.index', compact('data'));
    }

}
