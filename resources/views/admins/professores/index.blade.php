@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.professor.index')}}">Professores</a></li>
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarProfessor">
                                    <i class="fas fa-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['professores'] as $professor)
                                        <tr>
                                            <td>{{$professor->id}}</td>
                                            <td>{{$professor->nome}}</td>
                                            <td>{{$professor->cpf}}</td>
                                            <td>{{$professor->telefone}}</td>
                                            <td>{{$professor->email}}</td>
                                            <td>
                                                <button title="Editar professor" data-bs-toggle="modal" data-bs-target="#editarProfessor@php echo $professor->id @endphp" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                                <a title="Disciplinas do professor" href="{{ route('admin.professor.disciplina.index', $professor->id) }}" style="background: transparent">
                                                    <i class="fas fa-chalkboard text-success"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal editar professor -->
                                        <div class="modal fade" id="editarProfessor@php echo $professor->id @endphp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dados professor #<strong>{{$professor->id}}</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEditarProfessor{{$professor->id}}" method="post" action="{{ route('admin.professor.update', $professor->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" value="{{$professor->id}}" />
                                                            <div class="row">
                                                                <div class="alert alert-warning">
                                                                    <span class="required"></span>
                                                                    Campos obrigatórios!
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="nome">Nome:</label>
                                                                        <input type="text" id="nome" name="nome" class="form-control" required value="{{$professor->nome}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="telefone">Telefone:</label>
                                                                        <input type="text" id="telefone" name="telefone" class="form-control" required value="{{$professor->telefone}}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" onclick="$('#formEditarProfessor{{$professor->id}}').submit()">Salvar</button>
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
    <!-- Modal adicionar professor -->
    <div class="modal fade" id="adicionarProfessor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo professor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarProfessor" method="post" action="{{ route('admin.professor.store') }}">
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
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="email">E-mail:</label>
                                    <input type="email" id="email" name="email" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="cpf">CPF:</label>
                                    <input type="text" id="cpf" name="cpf" required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="telefone">Telefone:</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#criarProfessor').submit()">Salvar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

