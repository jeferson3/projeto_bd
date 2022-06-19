<?php

use Illuminate\Support\Facades\Route;

Route::redirect('', 'auth/alunos');

Route::group(["prefix" => "auth", 'as' => 'auth.'], function (){
    Route::group(["prefix" => "admins", 'as' => 'admin.'], function (){
        Route::get('', [\App\Http\Controllers\Auth\AuthController::class, "indexAdmin"])->name('login.index');
        Route::post('', [\App\Http\Controllers\Auth\AuthController::class, "loginAdmin"])->name('login');
        Route::post('/sair', [\App\Http\Controllers\Auth\AuthController::class, "logoutAdmin"])->name('logout');
    });
    Route::group(["prefix" => "alunos", 'as' => 'aluno.'], function (){
        Route::get('', [\App\Http\Controllers\Auth\AuthController::class, "indexAluno"])->name('login.index');
        Route::post('', [\App\Http\Controllers\Auth\AuthController::class, "loginAluno"])->name('login');
        Route::post('/sair', [\App\Http\Controllers\Auth\AuthController::class, "logoutAluno"])->name('logout');
    });
    Route::group(["prefix" => "professores", 'as' => 'professor.'], function (){
        Route::get('', [\App\Http\Controllers\Auth\AuthController::class, "indexProfessor"])->name('login.index');
        Route::post('', [\App\Http\Controllers\Auth\AuthController::class, "loginProfessor"])->name('login');
        Route::post('/sair', [\App\Http\Controllers\Auth\AuthController::class, "logoutProfessor"])->name('logout');
    });
});

Route::group(["prefix" => "/"], function (){
    Route::group(["prefix" => "/admins", 'as' => 'admin.'], function (){
        Route::get('dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
        Route::resource('/cursos', \App\Http\Controllers\Admin\CursoController::class)->names('curso');
        Route::resource('/alunos', \App\Http\Controllers\Admin\AlunoController::class)->names('aluno');
        Route::resource('/professores', \App\Http\Controllers\Admin\ProfessorController::class)->names('professor')
            ->parameters([
                'professores' => 'professor'
            ]);
        Route::resource('/disciplinas', \App\Http\Controllers\Admin\DisciplinaController::class)->names('disciplina');

        Route::get('/cursos/{curso}/disciplinas', [\App\Http\Controllers\Admin\CursoController::class, 'disciplinasIndex'])->name('curso.disciplina.index');
        Route::post('/cursos/{curso}/disciplinas', [\App\Http\Controllers\Admin\CursoController::class, 'disciplinasStore'])->name('curso.disciplina.store');
        Route::delete('/cursos/{curso}/disciplinas', [\App\Http\Controllers\Admin\CursoController::class, 'disciplinasDestroy'])->name('curso.disciplina.delete');
        Route::get('/cursos/{curso}/alunos', [\App\Http\Controllers\Admin\CursoController::class, 'alunosIndex'])->name('curso.aluno.index');

        Route::get('/professores/{professor}/disciplinas', [\App\Http\Controllers\Admin\ProfessorController::class, 'disciplinasIndex'])->name('professor.disciplina.index');
        Route::post('/professores/{professor}/disciplinas', [\App\Http\Controllers\Admin\ProfessorController::class, 'disciplinasStore'])->name('professor.disciplina.store');
        Route::delete('/professores/{professor}/disciplinas', [\App\Http\Controllers\Admin\ProfessorController::class, 'disciplinasDestroy'])->name('professor.disciplina.delete');

        Route::get('/disciplinas/{disciplina}/cursos', [\App\Http\Controllers\Admin\DisciplinaController::class, 'cursosIndex'])->name('disciplina.curso.index');
        Route::get('/disciplinas/{disciplina}/professores', [\App\Http\Controllers\Admin\DisciplinaController::class, 'professoresIndex'])->name('disciplina.professor.index');
        Route::get('/disciplinas/{disciplina}/alunos', [\App\Http\Controllers\Admin\DisciplinaController::class, 'alunosIndex'])->name('disciplina.aluno.index');

    });
    Route::group(["prefix" => "/alunos", 'as' => 'aluno.'], function (){
        Route::get('dashboard', [\App\Http\Controllers\Aluno\AlunoController::class, 'index'])->name('home');
    });
    Route::group(["prefix" => "/professores", 'as' => 'professor.'], function (){
        Route::get('dashboard', [\App\Http\Controllers\Professor\ProfessorController::class, 'index'])->name('home');
        Route::group(["prefix" => "/disciplinas", 'as' => 'disciplina.'], function (){
            Route::get('/{disciplina}/alunos', [\App\Http\Controllers\Professor\ProfessorController::class, 'alunosDisciplina'])->name('aluno.index');
            Route::put('/alunos', [\App\Http\Controllers\Professor\ProfessorController::class, 'editarAlunoDisciplina'])->name('aluno.edit');
        });
    });
});
