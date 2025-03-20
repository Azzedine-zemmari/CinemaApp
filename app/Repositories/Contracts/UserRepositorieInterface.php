<?php

namespace App\Repositories\Contracts;

interface UserRepositorieInterface{
    public function create(array $data);
    public function findByEmail(string $email);
}