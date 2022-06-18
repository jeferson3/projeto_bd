@extends('layouts.admin')

@section('content')
    <div class="bg-gray-{{$data['alunos']}}0 p-5">
        <h2 class="mt-2 mb-4">Dashboard</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 border-3 border-primary border-start rounded-start">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            Cursos
                        </h6>
                        <h5 class="card-title">{{$data['cursos']}}</h5>
                        <p class="card-icon" style="float: right">
                            <i class="fas fa-graduation-cap fa-3x text-gray-500"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 border-3 border-success border-start rounded-start">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            Alunos
                        </h6>
                        <h5 class="card-title">{{$data['alunos']}}</h5>
                        <p class="card-icon" style="float: right">
                            <i class="fas fa-user-graduate fa-3x text-gray-500"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 border-3 border-warning border-start rounded-start">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            Disciplinas
                        </h6>
                        <h5 class="card-title">{{$data['disciplinas']}}</h5>
                        <p class="card-icon" style="float: right">
                            <i class="fas fa-chalkboard fa-3x text-gray-500"></i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 border-3 border-danger border-start rounded-start">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">
                            Professores
                        </h6>
                        <h5 class="card-title">{{$data['professores']}}</h5>
                        <p class="card-icon" style="float: right">
                            <i class="fas fa-chalkboard-teacher fa-3x text-gray-500"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
