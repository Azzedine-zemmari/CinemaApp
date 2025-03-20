<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositorieInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthService{
    protected $userRepository;

    public function __construct(UserRepositorieInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data){
        $user = $this->userRepository->create([
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
        $user = $this->userRepository->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null; // Invalid credentials
        }

        // Generate a JWT token for the authenticated user
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}