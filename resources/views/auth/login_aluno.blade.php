@extends('layouts.auth')
@section('content')
<div>
    <h5>Área do aluno</h5>
    @php
        $action = route('auth.aluno.login')
    @endphp
    <x-component-login :action="$action"></x-component-login>
</div>
@endsection
