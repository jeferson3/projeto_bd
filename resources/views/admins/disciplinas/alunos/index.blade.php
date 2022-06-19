@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.disciplina.index')}}">Disciplinas</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.disciplina.curso.index', $data['disciplina']->id)}}">{{$data['disciplina']->nome}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.disciplina.curso.index', $data['disciplina']->id)}}">Alunos</a></li>
            </ol>
        </nav>
        <div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="my-2 text-end">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Data de nascimento</th>
                                        <th>E-mail</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['alunos'] as $aluno)
                                        <tr>
                                            <td>{{$aluno->id}}</td>
                                            <td>{{$aluno->nome}}</td>
                                            <td>{{$aluno->data_nascimento}}</td>
                                            <td>{{$aluno->email}}</td>
                                            <td>{{$aluno->cpf}}</td>
                                            <td>{{$aluno->rg}}</td>
                                            <td>{{$aluno->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

