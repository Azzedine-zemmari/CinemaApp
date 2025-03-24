<?php

namespace App\Repositories\Contracts;

interface FilmRepositorieInterface{
    public function create(array $data);
    public function update(int $id , array $data);
}