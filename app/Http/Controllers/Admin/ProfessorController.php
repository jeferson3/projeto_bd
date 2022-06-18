<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    private Professor $modelProfessor;

    public function __construct(Professor $professor)
    {
        $this->modelProfessor = $professor;
        $this->middleware('authAdmin');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'professores' => $this->modelProfessor->orderBy('id', 'desc')->get(),
            'disciplinas' => Disciplina::all()
        ];
//        dd($data->toArray());
        return view('admins.professores.index', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $res = $this->modelProfessor->novoProfessor($request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados registrados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.professor.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Professor $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Professor $professor)
    {
        try {
            $res = $this->modelProfessor->atualizarProfessor($professor, $request->all());
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.professor.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

    /**
     * @param Request $request
     * @param Professor $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Professor $professor)
    {
        try {
            $res = $this->modelProfessor->deletarProfessor($professor);
            return redirect()
                ->back()
                ->with('success', 'Dados atualizados com sucesso!');
        }
        catch (\Exception $exception){
            return redirect(route('admin.professor.index'))
                ->with('error', 'Aconteceu um erro inesperado!');
        }
    }

}
