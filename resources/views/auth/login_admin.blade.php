@extends('layouts.auth')
@section('content')
<div>
    <h5>Administração</h5>
    @php
        $action = route('auth.admin.login')
    @endphp
    <x-component-login :action="$action"></x-component-login>
</div>
@endsection
