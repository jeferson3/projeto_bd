@extends('layouts.aluno')

@section('content')
    <div class="bg-gray-100 p-5">
        <a href="{{route('professor.home')}}">
            <i class="fas fa-arrow-left"></i>
            Voltar
        </a>
        <h2 class="mt-2 mb-4">Alunos da disciplina</h2>
        <div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            {{$data['disciplina']->nome}}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h5>Alunos</h5>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Aluno</th>
                                    <th>Frequência</th>
                                    <th>Nota 1º Bimestre</th>
                                    <th>Nota 2º Bimestre</th>
                                    <th>Média</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['alunos'] as $aluno)
                                        <tr>
                                            <td>
                                                @switch($aluno->status)
                                                    @case('cursando')
                                                        <span class="badge bg-primary">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($aluno->status)}}
                                                        </span>
                                                        @break
                                                    @case('aprovado')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($aluno->status)}}
                                                        </span>
                                                        @break
                                                    @case('reprovado')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($aluno->status)}}
                                                        </span>
                                                        @break
                                                    @case('trancado')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-thumbtack"></i>
                                                            {{ucwords($aluno->status)}}
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>{{$aluno->nome}}</td>
                                            <td>{{$aluno->frequencia}}%</td>
                                            <td>{{$aluno->nota_bimestre1}}</td>
                                            <td>{{$aluno->nota_bimestre2}}</td>
                                            <td style="color: @php echo $aluno->media >= 7 ? 'green' : 'red' @endphp; font-weight: bold">{{$aluno->media}}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#editarAluno@php echo $aluno->id @endphp" style="background: transparent">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal editar aluno -->
                                        <div class="modal fade" id="editarAluno@php echo $aluno->id @endphp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dados aluno <strong>@php echo $aluno->nome @endphp</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formEditarAluno{{$aluno->id}}" method="post" action="{{route('professor.disciplina.aluno.edit')}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="aluno" value="{{$aluno->id}}" />
                                                            <input type="hidden" name="disciplina" value="{{$data['disciplina']->id}}" />
                                                            <input type="hidden" name="status" value="{{$aluno->status}}" />
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" id="lbl_frequencia{{$aluno->id}}" for="frequencia{{$aluno->id}}">Frequência({{$aluno->frequencia}}%):</label>
                                                                        <input type="range" id="frequencia{{$aluno->id}}" name="frequencia" class="form-range" min="0" max="100" step="0.1" value="{{$aluno->frequencia}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" for="nota_bimestre1">Nota 1º Bimentre:</label>
                                                                        <input type="number" id="nota_bimestre1" name="nota_bimestre1" class="form-control" value="{{$aluno->nota_bimestre1}}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group my-2">
                                                                        <label class="form-label" for="nota_bimestre2">Nota 1º Bimentre:</label>
                                                                        <input type="number" id="nota_bimestre2" name="nota_bimestre2" class="form-control" value="{{$aluno->nota_bimestre2}}" />
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
                                        @section('scripts')
                                            <script>
                                                $('#frequencia{{$aluno->id}}').on('input', function (e) {
                                                    $('#lbl_frequencia{{$aluno->id}}').text("Frequência(" + e.target.value + "%):")
                                                })
                                            </script>
                                        @endsection
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

