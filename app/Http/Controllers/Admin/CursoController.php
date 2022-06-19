<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    private Curso $modelCurso;

    public function __construct(Curso $curso)
    {
        $this->modelCurso = $curso;
        $this->middleware('authAdmin');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = $this->modelCurso->orderBy('id', 'desc')->get();
//        dd($data);
        return view('admins.cursos.index', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $res = $this->modelCurso->novoCurso($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados registrados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.curso.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Curso $curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Curso $curso)
    {
        try {
            $res = $this->modelCurso->atualizarCurso($curso, $request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.curso.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Curso $curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Curso $curso)
    {
        try {
            $res = $this->modelCurso->deletarCurso($curso);
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.curso.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Curso $curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alunosIndex(Request $request, Curso $curso)
    {
        $data = [
            'alunos'    => $curso->Alunos,
            'curso'     => $curso,
            'cursos'    => Curso::all()
        ];
        return view('admins.cursos.alunos.index', compact('data'));
    }

    /**
     * @param Request $request
     * @param Curso $curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasIndex(Request $request, Curso $curso)
    {
        $data = [
            'curso'             => $curso,
            'disciplinas'       => Disciplina::all()->except($curso->Disciplinas()->select('id')->get()->pluck('id')->toArray()),
            'disciplinas_curso' => $curso->Disciplinas,

        ];
        return view('admins.cursos.disciplinas.index', compact('data'));
    }

    /**
     * @param Request $request
     * @param Curso $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasStore(Request $request)
    {
        try {
            $res = $this->modelCurso->novaDisciplinaCurso($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.curso.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Curso $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasDestroy(Request $request)
    {
        try {
            $res = $this->modelCurso->deletarDisciplinaCurso($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.curso.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

}
