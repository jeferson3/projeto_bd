<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Professor;

class AdminController extends Controller
{

    private Admin $modelAdmin;

    public function __construct(Admin $curso)
    {
        $this->modelAdmin = $curso;
        $this->middleware('authAdmin');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
          'cursos'      => Curso::all()->count(),
          'disciplinas' => Disciplina::all()->count(),
          'alunos'      => Aluno::all()->count(),
          'professores' => Professor::all()->count(),
        ];
        return view('admins.index', compact('data'));
    }
}
