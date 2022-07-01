@extends('layouts.main')

@section('title', 'TSB Games')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Game</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="games-container" class="col-md-12">
    @if($search)
    <h2>Buscando por {{$search}}</h2>
    @else
    <h2>Games disponíveis</h2>
    <p class ="subtitle">Veja os games disponíveis</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($games as $game)
        <div class="card col-md-3">
            <img src="/img/games/{{$game->image}}" alt="{{ $game->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $game->title }}</h5>
                <p class="card-interessados">{{count($game->users)}} Interessados no game</p>
                <a href="/games/{{ $game->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($games) == 0 && $search)
        <p>Não foi possível encontrar nenhum game com: {{$search}}! <a href="/">Ver todos</a></p>
        @elseif(count($games) == 0)
        <p>Não há games disponíveis</p>
        @endif
    </div>
</div>
@endsection