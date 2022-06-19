<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    private Aluno $modelAluno;

    public function __construct(Aluno $aluno)
    {
        $this->modelAluno = $aluno;
        $this->middleware('authAdmin');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'alunos' => $this->modelAluno->with('Curso')->orderBy('id', 'desc')->get(),
            'cursos' => Curso::all()
        ];
//        dd($data->toArray());
        return view('admins.alunos.index', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $res = $this->modelAluno->novoAluno($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados registrados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.aluno.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Aluno $aluno
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Aluno $aluno)
    {
        try {
            $res = $this->modelAluno->atualizarAluno($aluno, $request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.aluno.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Aluno $aluno
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Aluno $aluno)
    {
        try {
            $res = $this->modelAluno->deletarAluno($aluno);
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.aluno.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Aluno $aluno
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasIndex(Request $request, Aluno $aluno)
    {
        $data = [
            'aluno'                 => $aluno,
            'disciplinas'           => Disciplina::all()->except($aluno->Disciplinas()->select('id')->get()->pluck('id')->toArray()),
            'disciplinas_aluno'     => $aluno->Disciplinas()->selectRaw('*, media_aluno_disciplina(nota_bimestre1, nota_bimestre2) media')->get()
        ];
        return view('admins.alunos.disciplinas.index', compact('data'));
    }

    /**
     * @param Request $request
     * @param Aluno $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasStore(Request $request)
    {
        try {
            $res = $this->modelAluno->novaDisciplinaAluno($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.aluno.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Aluno $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disciplinasUpdate(Request $request)
    {
        try {
            $res = $this->modelAluno->atualizarDisciplinaAluno($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.aluno.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

}
