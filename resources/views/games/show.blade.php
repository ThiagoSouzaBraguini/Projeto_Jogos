@extends('layouts.main')

@section('title', $game->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class = "row">
        <div id="image-container" class="col-md-6">
            <img src="/img/games/{{$game->image}}" class = "img-fluid" alt="$game->title">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$game->title}}</h1>
            <p class="game-genero"><ion-icon name="game-controller"></ion-icon>Genero: {{$game->genero}}</p>
            <p class="game-plataforma"><ion-icon name="game-controller"></ion-icon>Plataforma: {{$game->plataforma}}</p>
            <p class="game-preco"> <ion-icon name="game-controller"></ion-icon>Preço:R${{$game->preco}}</p>
        @if(!$hasUserJoined)
            <form action="/games/join/{{$game->id}}" method ="POST">
                @csrf
                <a  href="#"
                    class="btn btn-primary" 
                    id="game-submit"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    Adicionar a Lista de desejos
                </a>
            </form>
        @else
            <p class = "alredy-joined-msg">Esse game já esta na sua lista de interesses!</p>
        @endif
        </div>
        <div class="col-md-12" id></div>
    </div>
</div>

@endsection
