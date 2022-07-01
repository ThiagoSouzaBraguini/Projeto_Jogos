@extends('layouts.main')

@section('title', 'Editando Game: ' . $game->title)

@section('content')

<div id="game-create-container" class="col-md-6 offset-md-3">
    <h1>Editando {{$game->title}}</h1>
    <form action="/games/update/{{$game->id}}" method = "POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class= "form-group">
            <label for="image">Imagem do Game:</label>
            <input type="file" id="image" name = "image" class="form-control-file">
            <img src="/img/games/{{ $game->image }}" alt="{{ $game->title }}" class="img-preview">
        </div>
        <div class= "form-group">
            <label for="title">Nome:</label>
            <input type="text" class= "form-control" id="title" name="title" placeholder = "Nome do Jogo" value= "{{$game->title}}">
        </div>
        <div class= "form-group">
            <label for="title">Gênero:</label>
            <input type="text" class= "form-control" id="genero" name="genero" value = "{{$game->genero}}">
        </div>
        <div class= "form-group">
            <label for="title">Preço:</label>
            <input type="number" class= "form-control" id="preco" name="preco" placeholder = "Preço do jogo" value = "{{$game->preco}}">
        </div>
        <div class= "form-group">
            <label for="title">Adicione a plataforma disponível:</label>
            <select  name="plataforma" id="plataforma" class="form-control">
                <option selected>Selecione a plataforma disponível</option>
                <option value="PC">PC</option>
                <option value="Playstation">Playstation</option>
                <option value="X-Box">X-Box</option>
                <option value="Todas as Plataformas">Todas as Plataformas</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value= "Editar Game">
    </form>
</div>

@endsection