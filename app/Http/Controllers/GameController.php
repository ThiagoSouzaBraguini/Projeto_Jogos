<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;

class GameController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $games = Game::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }
        else{
            $games = Game::all();
        }

        

        return view('welcome',['games' => $games, 'search' => $search]);
    }

    public function create(){
        return view('games.create');
    }

    public function store(Request $request){
        
        $game = new Game;

        $game->title = $request->title;
        $game->genero = $request->genero;
        $game->preco = $request->preco;
        $game->plataforma = $request->plataforma;

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/games'), $imageName);

            $game->image = $imageName;

        }

        $user = auth()->user();
        $game->user_id = $user->id;

        $game->save();

        return redirect('/')->with('msg','Game Cadastrado com sucesso!');
        
    }

    public function show($id){

        $game = Game::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){

            $userGames = $user->gamesAsParticipant->toArray();
            
            foreach($userGames as $userGames){
                if($userGames['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        return view('.games.show',['game' => $game, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){

        $user = auth()->user();

        $games = $user->games;

        $gamesAsParticipant = $user->gamesAsParticipant;


        return view('games.dashboard',
            ['games' => $games, 'gamesasparticipant' => $gamesAsParticipant]);

    }


    public function destroy($id){
        Game::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg','Game excluído com sucesso!');
    }

    public function edit($id) {

        $user = auth()->user();

        $game = Game::findOrFail($id);

        if($user->id != $game->user_id){
            return redirect('/dashboard');
        }

        return view('games.edit', ['game' => $game]);

    }

    public function update(Request $request) {

        $data = $request->all();

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/games'), $imageName);

            $data['image'] = $imageName;

        }

        Game::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Game editado com sucesso!');

    }

    public function addList($id){

        $user = auth()->user();

        $user->gamesAsParticipant()->attach($id);

        $game = Game::findOrFail($id);

        return redirect('/dashboard')->with('msg','O game foi adicionado na sua lista de desejos');
    }

    public function leaveGame($id){

        $user = auth()->user();

        $user->gamesAsParticipant()->detach($id);

        $game = Game::findOrFail($id);

        return redirect('/dashboard')->with('msg','O game foi tirado da sua lista de interesses: ' . $game->title);
    }

}


