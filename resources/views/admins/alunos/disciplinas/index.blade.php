@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.aluno.index')}}">Alunos</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.aluno.disciplina.index', $data['aluno']->id)}}">{{$data['aluno']->nome}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.aluno.disciplina.index', $data['aluno']->id)}}">Disciplinas</a></li>
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarDisciplina">
                                    <i class="fas fa-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Disciplina</th>
                                    <th>Frequência</th>
                                    <th>Nota 1º Bimestre</th>
                                    <th>Nota 2º Bimestre</th>
                                    <th>Média</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['disciplinas_aluno'] as $disciplina)
                                        <tr>
                                            <td>
                                                @switch($disciplina->status)
                                                    @case('cursando')
                                                        <span class="badge bg-primary">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($disciplina->status)}}
                                                        </span>
                                                        @break
                                                    @case('aprovado')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($disciplina->status)}}
                                                        </span>
                                                        @break
                                                    @case('reprovado')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($disciplina->status)}}
                                                        </span>
                                                        @break
                                                    @case('trancado')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($disciplina->status)}}
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>{{$disciplina->nome}}</td>
                                            <td>{{$disciplina->frequencia}}%</td>
                                            <td>{{$disciplina->nota_bimestre1 ?? '-'}}</td>
                                            <td>{{$disciplina->nota_bimestre2 ?? '-'}}</td>
                                            <td style="color: {{$disciplina->media >= 7 ? 'green' : 'red'}}; font-weight: bold">{{$disciplina->media ?? '-'}}</td>
                                            <td>
                                                <button title="Atualizar matrícula" data-bs-toggle="modal" data-bs-target="#editarAluno{{$disciplina->id}}" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </td>
                                            <!-- Modal editar aluno -->
                                            <div class="modal fade" id="editarAluno{{$disciplina->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Dados matrícula do aluno na disciplina</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="formEditarAluno{{$data['aluno']->id}}" method="post" action="{{route('admin.aluno.disciplina.update', $data['aluno']->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="aluno_id" value="{{$data['aluno']->id}}" />
                                                                <input type="hidden" name="disciplina_id" value="{{$disciplina->id}}" />
                                                                <input type="hidden" name="frequencia" value="{{$disciplina->frequencia}}" />
                                                                <input type="hidden" name="nota_bimestre1" value="{{$disciplina->nota_bimestre1}}" />
                                                                <input type="hidden" name="nota_bimestre2" value="{{$disciplina->nota_bimestre2}}" />
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group my-2">
                                                                            <label class="form-label" for="status">Status:</label>
                                                                            <select id="status" name="status" class="form-control">
                                                                                <option {{ $disciplina->status == 'cursando' ? 'selected' : '' }} value="cursando">Cursando</option>
                                                                                <option {{ $disciplina->status == 'aprovado' ? 'selected' : '' }} value="aprovado">Aprovado</option>
                                                                                <option {{ $disciplina->status == 'reprovado' ? 'selected' : '' }} value="reprovado">Reprovado</option>
                                                                                <option {{ $disciplina->status == 'trancado' ? 'selected' : '' }} value="trancado">Trancado</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                            <button type="button" class="btn btn-primary" onclick="$('#formEditarAluno{{$data['aluno']->id}}').submit()">Salvar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <!-- Modal adicionar disciplina -->
    <div class="modal fade" id="adicionarDisciplina" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova disciplina para o aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarDisciplina" method="post" action="{{ route('admin.aluno.disciplina.store', $data['aluno']->id) }}">
                        @csrf
                        <div class="row">
                            <div class="alert alert-warning">
                                <span class="required"></span>
                                Campos obrigatórios!
                            </div>
                            <input type="hidden" id="aluno_id" name="aluno_id" value="{{$data['aluno']->id}}" required />
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="aluno">Aluno:</label>
                                    <input type="text" id="aluno" disabled class="form-control" value="{{$data['aluno']->nome}}" required />
                                </div>
                                <div class="form-group my-2">
                                    <label class="form-label" for="disciplina_id">Disciplina:</label>
                                    <select id="disciplina_id" name="disciplina_id" class="form-control">
                                        <option value="">-- selecione --</option>
                                        @foreach($data['disciplinas'] as $disciplina)
                                            <option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#criarDisciplina').submit()">Salvar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

