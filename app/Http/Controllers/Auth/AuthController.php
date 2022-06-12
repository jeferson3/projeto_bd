<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAluno;
use App\Http\Requests\LoginProfessor;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function indexAluno()
    {
        return view('auth.login_aluno');
    }

    public function indexProfessor()
    {
        return view('auth.login_professor');
    }

    public function loginAluno(LoginAluno $request)
    {
        $dados = ['email' => $request->get('email'), 'password' => $request->get('senha')];
        if (auth()->guard('aluno')->attempt($dados)){
            return redirect(route('aluno.home'));
        }
        return redirect(route('aluno.login.index'))
            ->with('error', 'Crendenciais incorretas!')
            ->withInput(['email' => $dados['email']]);
    }

    public function loginProfessor(LoginProfessor $request)
    {
        $dados = ['email' => $request->get('email'), 'password' => $request->get('senha')];
        if (auth()->guard('professor')->attempt($dados)){
            return redirect(route('professor.home'));
        }
        return redirect(route('professor.login.index'))
            ->with('error', 'Crendenciais incorretas!')
            ->withInput(['email' => $dados['email']]);
    }

    public function logoutAluno()
    {
        auth()->guard('aluno')->logout();
        return redirect(route("auth.aluno.login.index"));
    }

    public function logoutProfessor()
    {
        auth()->guard('professor')->logout();
        return redirect(route("auth.professor.login.index"));
    }

}
