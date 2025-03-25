<?php 

namespace App\Repositories\Contracts;

interface SessionRepositorieInterface{
    public function create(array $data);
    public function findBytype(string $type);
    public function showdata();
}