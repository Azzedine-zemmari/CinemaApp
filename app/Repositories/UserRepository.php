<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class UserRepository implements UserRepositorieInterface{
    public function create(array $data){
        return User::create(
            [
                'name'=>$data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
    }
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
    public function findById(int $id)
    {
        return User::find($id);
    }
    public function update(int $id, array $data)
    {
        $user = $this->findById($id);
    
        if($user || $user->id === Auth::id()){
            $user->update($data);
            return $user;
        }
        return null;
    }
}