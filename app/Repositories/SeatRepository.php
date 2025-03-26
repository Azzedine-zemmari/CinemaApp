<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\SeatRepositorieInterface;


class SeatRepository implements SeatRepositorieInterface{
    public function create(array $seats)
    {
        return DB::table('seats')->insert($seats);
    }
}