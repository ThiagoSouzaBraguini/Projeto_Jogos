@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minha Lista de Games</h1>
</div>

<div class="col-md-10 offset-md-1 games-container">
    @if(count($games)> 0)

    @else
    <p>Você ainda não tem games cadastrados, <a href="/games/create">Cadastrar Game</a> </p> 
    @endif
</div>

@endsection
