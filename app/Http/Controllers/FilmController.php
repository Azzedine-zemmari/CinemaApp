<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\FilmRepositorieInterface;

class FilmController extends Controller
{
    private $filmRepository;

    public function __construct(FilmRepositorieInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function addFilm(Request $request){
        $data = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'image' => 'required',
            'duree' => 'required',
            'ageMin' => 'required',
            'triller' => 'required',
            'genre' => 'required'
        ]);

        $result = $this->filmRepository->create($data);
        return response()->json(['message' => 'ok', 'result' => $result]);
    }
    public function updateFilm(Request $request,$id){
        $data = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'image' => 'required',
            'duree' => 'required',
            'ageMin' => 'required',
            'triller' => 'required',
            'genre' => 'required'
        ]);
    
        $result = $this->filmRepository->update($id, $data);
    
        if (!$result) {
            return response()->json(['message' => 'Film not found or update failed'], 404);
        }
    
        return response()->json(['message' => 'Film updated successfully', 'result' => $result]);
    }
}
