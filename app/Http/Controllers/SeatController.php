<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\SeatRepositorieInterface;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    private $seatRepository;
    public function __construct(SeatRepositorieInterface $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }
    public function createseats(int $salleId,int $numOfSeats){
        $salle = DB::table('salles')
        ->select('capacity')
        ->where('id',$salleId)
        ->first();

        if (!$salle) {
            return response()->json(['message' => 'Salle not found'], 404);
        }

        if ($numOfSeats > $salle->capacity) {
            return response()->json(['message' => 'Number of seats exceeds room capacity'], 400);
        }

        $seats = [];
        for ($i=0; $i < $numOfSeats; $i++) { 
            $seats[] = [
                'num'=>$i+1,
                'status' => true,
                'salleId' =>$salleId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $this->seatRepository->create($seats);
        
            return response()->json([
                'message'=>'ok',
            ],201);

    } 
}
