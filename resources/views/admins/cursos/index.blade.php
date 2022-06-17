@extends('layouts.professor')

@section('content')
    <div class="bg-gray-100 p-5">
        <a href="{{route('admin.home')}}">
            <i class="fas fa-arrow-left"></i>
            Voltar
        </a>
        <h2 class="mt-2 mb-4">Cursos</h2>
        <div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Meus cursos
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="my-2 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarCurso">
                                    <i class="fas fa-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $curso)
                                        <tr>
                                            <td>{{$curso->id}}</td>
                                            <td>{{$curso->nome}}</td>
                                            <td>{{ucfirst($curso->tipo)}}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#editarAluno@php echo $curso->id @endphp" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal editar curso -->
                                        <div class="modal fade" id="editarAluno@php echo $curso->id @endphp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dados curso #<strong>{{$curso->id}}</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEditarAluno{{$curso->id}}" method="post" action="{{ route('admin.curso.update', $curso->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id" value="{{$curso->id}}" />
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" for="nome">Nome:</label>
                                                                        <input type="text" id="nome" name="nome" class="form-control" value="{{$curso->nome}}" />
                                                                    </div>
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" for="tipo">Tipo:</label>
                                                                        <select id="tipo" name="tipo" class="form-control">
                                                                            <option value="licenciatura" {{ $curso->tipo === 'licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                                                            <option value="bacharelado" {{ $curso->tipo === 'bacharelado' ? 'selected' : '' }}>Bacharelado</option>
                                                                            <option value="tecnico" {{ $curso->tipo === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" onclick="$('#formEditarAluno{{$curso->id}}').submit()">Salvar</button>
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
    <!-- Modal adicionar curso -->
    <div class="modal fade" id="adicionarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="criarCurso" method="post" action="{{ route('admin.curso.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <label class="form-label" for="nome">Nome:</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required />
                                </div>
                                <div class="form-group my-2">
                                    <label class="form-label" for="tipo">Tipo:</label>
                                    <select id="tipo" name="tipo" class="form-control" required>
                                        <option>-- selecione --</option>
                                        <option value="licenciatura">Licenciatura</option>
                                        <option value="bacharelado">Bacharelado</option>
                                        <option value="tecnico">Técnico</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#criarCurso').submit()">Salvar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

