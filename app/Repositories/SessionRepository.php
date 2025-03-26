<?php

namespace App\Repositories;

use App\Models\Session;
use App\Repositories\Contracts\SessionRepositorieInterface;
use Illuminate\Support\Facades\DB;

class SessionRepository implements SessionRepositorieInterface{

    public function create(array $data)
    {
        return Session::create([
            'filmId' => $data['filmId'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'salleId' => $data['salleId']
        ]);
    }
    public function findBytype(string $type)
    {
        return Session::where('type',$type)->get();
    }
    public function showdata()
    {
        return DB::table('sessions')
        ->join('films','films.id','=','sessions.filmId')
        ->select('*')
        ->get();
    }
}