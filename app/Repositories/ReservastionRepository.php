<?php

namespace App\Repositories;

use App\Models\reservation;
use App\Repositories\Contracts\ReservationRepositorieInterface;
use Illuminate\Support\Facades\DB;

class ReservastionRepository implements ReservationRepositorieInterface{
    public function create(array $data)
    {
        return DB::table('reservations')->insert($data);
    }
}