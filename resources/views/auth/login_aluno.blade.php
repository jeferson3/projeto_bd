@extends('layouts.auth')
@section('content')
<div>
    <h5>Área do aluno</h5>
    <form method="post" action="{{route('auth.aluno.login')}}">
        @csrf
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="form-group">
                    <label class="required" for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required />
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 my-2">
                <div class="form-group">
                    <label class="required" for="senha">Senha: </label>
                    <input type="password" name="senha" id="senha" class="form-control @error('senha') is-invalid @enderror" required />
                    @error('senha')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-2 text-end">
                <input type="checkbox" name="lembrar" id="lembrar" class="" />
                <label for="lembrar">Lembrar de mim</label>
            </div>
            <div class="col-md-12 mt-3 text-center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in"></i>
                        Entrar
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
