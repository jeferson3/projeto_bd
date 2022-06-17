<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

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
//          'curso'       => auth()->user()->Curso,
//          'disciplinas' => auth()->user()->pegarDados,
        ];
        return view('admins.index', compact('data'));
    }
}
