@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <h2 class="mb-4">Gestão escolar</h2>
        <hr>
        <div>
            <div class="d-flex justify-content-around mx-auto" style="max-width: 50%">
                <a href="{{ route('admin.curso.index') }}" class="btn btn-primary">
                    <i class="fas fa-graduation-cap"></i>
                    Cursos
                </a>
                <a href="{{ route('admin.professor.index') }}" class="btn btn-primary">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Professores
                </a>
                <a href="{{ route('admin.disciplina.index') }}" class="btn btn-primary">
                    <i class="fas fa-chalkboard"></i>
                    Disciplinas
                </a>
                <a href="{{ route('admin.aluno.index') }}" class="btn btn-primary">
                    <i class="fas fa-user-graduate"></i>
                    Alunos
                </a>
            </div>
        </div>
    </div>

@endsection
