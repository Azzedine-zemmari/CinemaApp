<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserRepository implements UserRepositorieInterface{
    public function all(){
        return User::all();
    } 
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password'])]
        );

        $token = JWTAuth::fromUser($user);


        return [
            'user'=>$user,
            'token'=>$token
        ];
    }
}