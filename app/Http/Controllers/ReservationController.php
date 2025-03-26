<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ReservationRepositorieInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    private $reservationRepository;
    public function __construct(ReservationRepositorieInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }
    public function reserveAseat(Request $request , int $sessionId ,int $seatId){
        // Check if the seat exists and belongs to the given session
        $seat = DB::table('seats')->where('id', $seatId)->first();
        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        // Check if the session exists
        $session = DB::table('sessions')->where('id', $sessionId)->first();
        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        $salle = DB::table('sessions')
        ->select('salleId')
        ->where('id',$sessionId)
        ->first();

        if (!$salle) {
            return response()->json(['message' => 'Session not found'], 404);
        }
        // Check if the seat belongs to the salle (room) of this session
        $seat = DB::table('seats')
        ->where('id', $seatId)
        ->where('salleId', $salle->salleId)
        ->first();

        if (!$seat) {
            return response()->json(['message' => 'This seat does not belong to the room of the session'], 400);
        }
        // check the seats if is not reserved
        $isReserved = DB::table('reservations')
        ->where('seatsId',$seatId)
        ->where('sessionId',$sessionId)
        ->exists();

        if($isReserved){
            return response()->json(['message' => 'Seat already reserved'], 400);
        }
        $data = [
            'userId' => Auth::id(),
            'seatsId' => $seatId,
            'sessionId' => $sessionId,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $result = $this->reservationRepository->create($data);
        if($result){
            return response()->json(['message'=>'ok']);
        }
        else{
            return response()->json(['message'=>'error']);
        }
    }
    public function reserveVipSeat(Request $request, int $sessionId, int $seatId)
{
    // Check if the session exists
    $session = DB::table('sessions')->where('id', $sessionId)->first();
    if (!$session) {
        return response()->json(['message' => 'Session not found'], 404);
    }

    // Find the room associated with this session
    $salle = DB::table('sessions')->where('id', $sessionId)->value('salleId');
    if (!$salle) {
        return response()->json(['message' => 'Salle not found'], 404);
    }

    // Check if the selected seat exists and belongs to the salle
    $seat = DB::table('seats')
        ->where('id', $seatId)
        ->where('salleId', $salle)
        ->first();

    if (!$seat) {
        return response()->json(['message' => 'This seat does not belong to the room of the session'], 400);
    }

    // Find the adjacent seat
    $adjacentSeat = DB::table('seats')
        ->where('salleId', $salle)
        ->where('num', $seat->num + 1) // Assuming adjacent seat is the next number
        ->first();

    if (!$adjacentSeat) {
        return response()->json(['message' => 'No adjacent seat found for VIP booking'], 400);
    }

    // Check if either seat is already reserved
    $isReserved = DB::table('reservations')
        ->where('sessionId', $sessionId)
        ->whereIn('seatsId', [$seatId, $adjacentSeat->id])
        ->exists();

    if ($isReserved) {
        return response()->json(['message' => 'One or both seats are already reserved'], 400);
    }

    // Reserve both seats
    $reservationData = [
        [
            'userId' => Auth::id(),
            'seatsId' => $seatId,
            'sessionId' => $sessionId,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'userId' => Auth::id(),
            'seatsId' => $adjacentSeat->id,
            'sessionId' => $sessionId,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ];

    DB::table('reservations')->insert($reservationData);

    return response()->json([
        'message' => 'VIP seats reserved successfully',
        'seats_reserved' => [$seatId, $adjacentSeat->id]
    ]);
}

}
