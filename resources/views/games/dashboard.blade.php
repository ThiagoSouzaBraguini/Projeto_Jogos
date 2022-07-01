@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Games Cadastrados</h1>
</div>

<div class="col-md-10 offset-md-1 games-container">
    @if(count($games)> 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Pessoas que desejam este game</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td scope="row">{{$loop->index + 1}}</td>
                    <td><a href="/games/{{$game->id}}">{{$game->title}}</a></td>
                    <td>{{count($game->users)}}</td>
                    <td><a href="/games/edit/{{$game->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a></td>
                    <form action="/games/{{ $game->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem games cadastrados, <a href="/games/create">Cadastrar Game</a> </p> 
    @endif
</div>



<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minha Lista de Interesse</h1>
</div>
<div class="col-md-10 offset-md-1 games-container">
@if(count($gamesasparticipant) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Pessoas que desejam este game</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gamesasparticipant as $game)
                <tr>
                    <td scope="row">{{$loop->index + 1}}</td>
                    <td><a href="/games/{{$game->id}}">{{$game->title}}</a></td>
                    <td>{{count($game->users)}}</td>
                    <td>
                        <form action="/games/leave/{{$game->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" delete-btn>
                                <ion-icon name="trash-outline"></ion-icon>Remover Game da Lista
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
<p>Você ainda não demosntrou interesse em nenhum game, <a href="/">Veja todos os games disponíveis</a></p>
@endif
</div>
@endsection
