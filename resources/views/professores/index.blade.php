@extends('layouts.professor')

@section('content')
    <div class="bg-gray-100 p-5">
        <h2 class="mb-5">Minhas disciplinas</h2>
        <div>
            @foreach($data['disciplinas'] as $disciplina)
            <div class="d-flex align-items-center justify-content-between" style="min-height: 50px; border-bottom: 2px solid; margin-bottom: 5px">
                <span>
                    {{$disciplina->disciplina_nome}}
                </span>
                <form action="{{route('professor.disciplina.aluno.index', $disciplina->disciplina_pk_id)}}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

@endsection
