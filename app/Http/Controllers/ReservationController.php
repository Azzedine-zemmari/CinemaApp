<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ReservationRepositorieInterface;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    private $reservationRepository;
    public function __construct(ReservationRepositorieInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }
    public function reserveAseat(Request $request , int $sessionId ,int $seatId){
        $validate = $request->validate([
            'seatId' => 'required|exists:seats,id',
            'sessionId' => 'required|exists:sessions,id'
        ]);
        $data = [
            'userId' => Auth::id(),
            'seatId' => $seatId,
            'sessionId' => $sessionId,
            'status' => true
        ];
        $result = $this->reservationRepository->create($data);
        if($result){
            return response()->json(['message'=>'ok','data'=>$result]);
        }
        else{
            return response()->json(['message'=>'error']);
        }
    }
}
