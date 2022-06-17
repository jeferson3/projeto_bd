@extends('layouts.auth')
@section('content')
    <div>
        <h5>Área do docente</h5>
        @php
            $action = route('auth.professor.login')
        @endphp
        <x-component-login :action="$action"></x-component-login>
    </div>
@endsection
