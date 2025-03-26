<?php

namespace App\Repositories;

use App\Models\reservation;
use App\Repositories\Contracts\ReservationRepositorieInterface;

class ReservastionRepository implements ReservationRepositorieInterface{
    public function create(array $data)
    {
        return reservation::create([
            "userId" => $data['userId'],
            "seatsId" => $data['seatsId'],
            "sessionId" => $data['sessionId'],
            "status" => $data['status']
        ]);
    }
}