<?php

namespace App\Repositories\Contracts;

interface UserRepositorieInterface{
    public function all();
    public function register(array $data);
}