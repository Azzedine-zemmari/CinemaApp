<?php 

namespace App\Repositories;

use App\Models\salle;
use App\Repositories\Contracts\SalleRepositorieInterface;

class SalleRepository implements SalleRepositorieInterface{
    public function create(array $data)
    {
        return salle::create([
            'nom' => $data['nom'],
            'type' => $data['type']
        ]);
    }
}