@extends('partials.app')

@section('content')
    <h1>Selamat datang di Dashboard, {{ auth()->user()->name }}</h1>
@endsection