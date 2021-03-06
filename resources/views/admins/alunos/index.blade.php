@extends('layouts.admin')

@section('content')
    <div class="bg-gray-100 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Início</a></li>
                <li class="breadcrumb-item active"><a href="{{route('admin.aluno.index')}}">Alunos</a></li>
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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarAluno">
                                    <i class="fas fa-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Email</th>
                                        <th>Curso</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['alunos'] as $aluno)
                                        <tr>
                                            <td>{{$aluno->id}}</td>
                                            <td>{{$aluno->nome}}</td>
                                            <td>{{$aluno->cpf}}</td>
                                            <td>{{$aluno->rg}}</td>
                                            <td>{{$aluno->email}}</td>
                                            <td>{{$aluno->curso->nome}}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#editarAluno@php echo $aluno->id @endphp" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                                <a title="Disciplinas do aluno" href="{{ route('admin.aluno.disciplina.index', $aluno->id) }}" style="background: transparent">
                                                    <i class="fas fa-chalkboard text-success"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal editar aluno -->
                                        <div class="modal fade" id="editarAluno@php echo $aluno->id @endphp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dados aluno #<strong>{{$aluno->id}}</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEditarAluno{{$aluno->id}}" method="post" action="{{ route('admin.aluno.update', $aluno->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" value="{{$aluno->id}}" />
                                                            <div class="row">
                                                                <div class="alert alert-warning">
                                                                    <span class="required"></span>
                                                                    Campos obrigatórios!
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="nome">Nome:</label>
                                                                        <input type="text" id="nome" name="nome" class="form-control" required value="{{$aluno->nome}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="data_nascimento">Data de nascimento:</label>
                                                                        <input type="date" id="data_nascimento" name="data_nascimento" required class="form-control" value="{{$aluno->data_nascimento}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label required" for="telefone">Telefone:</label>
                                                                        <input type="text" id="telefone" name="telefone" class="form-control" required value="{{$aluno->telefone}}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" onclick="$('#formEditarAluno{{$aluno->id}}').submit()">Salvar</button>
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
    </div>
    <!-- Modal adicionar aluno -->
    <div class="modal fade" id="adicionarAluno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarAluno" method="post" action="{{ route('admin.aluno.store') }}">
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
                                    <label class="form-label required" for="data_nascimento">Data de nascimento:</label>
                                    <input type="date" id="data_nascimento" name="data_nascimento" required class="form-control" />
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
                                    <label class="form-label required" for="rg">RG:</label>
                                    <input type="text" id="rg" name="rg" required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="telefone">Telefone:</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label required" for="curso_id">Curso:</label>
                                    <select id="curso_id" name="curso_id" required class="form-control">
                                        <option>-- selecione --</option>
                                        @foreach($data['cursos'] as $curso)
                                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#criarAluno').submit()">Salvar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

