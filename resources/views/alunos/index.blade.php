@extends('layouts.aluno')

@section('content')
    <div class="bg-gray-100 p-5">
        <h2 class="mb-4">Meus curso</h2>

        <div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            {{$data['curso']->nome}}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h5>Disciplinas</h5>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Disciplina</th>
                                    <th>Frequência</th>
                                    <th>Nota 1º Bimestre</th>
                                    <th>Nota 2º Bimestre</th>
                                    <th>Média</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['disciplinas'] as $disciplina)
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
                                            <td>{{$disciplina->disciplina_nome}}</td>
                                            <td>{{$disciplina->frequencia}}%</td>
                                            <td>{{$disciplina->nota_bimestre1}}</td>
                                            <td>{{$disciplina->nota_bimestre2}}</td>
                                            <td style="color: @php echo $disciplina->media >= 7 ? 'green' : 'red' @endphp; font-weight: bold">{{$disciplina->media}}</td>
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

@endsection
