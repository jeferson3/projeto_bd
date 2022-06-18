@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.disciplina.index')}}">Disciplinas</a></li>
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
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Pré-requisito</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['disciplinas'] as $disciplina)
                                        <tr>
                                            <td>{{$disciplina->id}}</td>
                                            <td>{{$disciplina->nome}}</td>
                                            <td>{{$disciplina->PreRequisito ? $disciplina->PreRequisito->nome : '-'}}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#editarAluno@php echo $disciplina->id @endphp" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal editar disciplina -->
                                        <div class="modal fade" id="editarAluno@php echo $disciplina->id @endphp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dados disciplina #<strong>{{$disciplina->id}}</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEditarAluno{{$disciplina->id}}" method="post" action="{{ route('admin.disciplina.update', $disciplina->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" value="{{$disciplina->id}}" />
                                                            <div class="row">
                                                                <div class="alert alert-warning">
                                                                    <span class="required"></span>
                                                                    Campos obrigatórios!
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="nome">Nome:</label>
                                                                        <input type="text" id="nome" name="nome" class="form-control" value="{{$disciplina->nome}}" />
                                                                    </div>
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" for="pre_requisito_id">Pré-requisito:</label>
                                                                        <select id="pre_requisito_id" name="pre_requisito_id" class="form-control">
                                                                            <option value="">-- selecione --</option>
                                                                            @foreach($data['disciplinas'] as $d)
                                                                                <option {{ $disciplina->PreRequisito && $disciplina->PreRequisito->id == $d->id ? 'selected' : ''}} value="{{$d->id}}">{{$d->nome}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" onclick="$('#formEditarAluno{{$disciplina->id}}').submit()">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Novo disciplina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarDisciplina" method="post" action="{{ route('admin.disciplina.store') }}">
                        @csrf
                        <div class="row">
                            <div class="alert alert-warning">
                                <span class="required"></span>
                                Campos obrigatórios!
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="nome">Nome:</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required />
                                </div>
                                <div class="form-group my-2">
                                    <label class="form-label" for="pre_requisito_id">Pré-requisito:</label>
                                    <select id="pre_requisito_id" name="pre_requisito_id" class="form-control">
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

