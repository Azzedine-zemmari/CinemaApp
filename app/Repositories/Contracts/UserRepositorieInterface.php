<?php

namespace App\Repositories\Contracts;

interface UserRepositorieInterface{
    public function all();
    public function register(array $data);
    public function login(array $data);
}