@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.curso.index')}}">Cursos</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.curso.disciplina.index', $data['curso']->id)}}">{{$data['curso']->nome}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.curso.disciplina.index', $data['curso']->id)}}">Disciplinas</a></li>
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
                                    <th>Curso</th>
                                    <th>Disciplina</th>
                                    <th>Carga horária</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['disciplinas_curso'] as $disciplina)
                                        <tr>
                                            <td>{{$data['curso']->nome}}</td>
                                            <td>{{$disciplina->nome}}</td>
                                            <td>{{$disciplina->pivot->carga_horaria}}</td>
                                            <td>
                                                <form method="post" action="{{ route('admin.curso.disciplina.delete', $data['curso']->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" id="curso_id" name="curso_id" value="{{$data['curso']->id}}" required />
                                                    <input type="hidden" id="disciplina_id" name="disciplina_id" value="{{$disciplina->id}}" required />
                                                    <button title="Remover disciplina do curso" style="background: transparent">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Nova disciplina para o professor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarDisciplina" method="post" action="{{ route('admin.curso.disciplina.store', $data['curso']->id) }}">
                        @csrf
                        <div class="row">
                            <div class="alert alert-warning">
                                <span class="required"></span>
                                Campos obrigatórios!
                            </div>
                            <input type="hidden" id="curso_id" name="curso_id" value="{{$data['curso']->id}}" required />
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="curso">Curso:</label>
                                    <input type="text" id="curso" disabled class="form-control" value="{{$data['curso']->nome}}" required />
                                </div>
                                <div class="form-group my-2">
                                    <label class="form-label required" for="carga_horaria">Carga horária:</label>
                                    <input type="number" id="carga_horaria" name="carga_horaria" class="form-control" min="60" value="60" required />
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

