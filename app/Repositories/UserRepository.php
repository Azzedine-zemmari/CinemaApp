<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

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
    public function login(array $data){
        $user = User::where('email',$data['email'])->first();

    if(!$user || !Hash::check($data['password'],$user->password)){
        return null;
    }

    $token = JWTAuth::fromUser($user);

    return [
        'user'=>$user,
        'token'=>$token
    ];
    }
}