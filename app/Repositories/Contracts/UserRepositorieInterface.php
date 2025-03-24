<?php

namespace App\Repositories\Contracts;

interface UserRepositorieInterface{
    public function create(array $data);
    public function findByEmail(string $email);
    public function findById(int $id);
    public function update(int $id,array $data);
    public function delete(int $id);
}