<?php 

namespace App\Repositories;

use App\Models\film;
use App\Repositories\Contracts\FilmRepositorieInterface;
class FilmRepository implements FilmRepositorieInterface{
    public function create(array $data)
    {
       return film::create([
            'titre'=>$data['titre'],
            'description'=> $data['description'],
            'image' => $data['image'],
            'duree' => $data['duree'],
            'ageMin' => $data['ageMin'],
            'triller' => $data['triller'],
            'genre' => $data['genre']
       ]);
    }
    public function update(int $id, array $data)
    {
        $film = Film::find($id);
        if(!$film){
            return false;
        }
        $film->update($data);
        return $film;
    }
    public function delete(int $id){
        $film = Film::find($id);

        if(!$film){
            return false;
        }
        $film->delete();
        return $film;
    }
    public function countTotalFilms(){
        return film::count();
    }
}