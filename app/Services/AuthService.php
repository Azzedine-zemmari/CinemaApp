<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositorieInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            'password' => Hash::make($data['password']) 
        ]);
    
        $token = JWTAuth::fromUser($user);
    
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
    
    public function login(array $data){
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Generate a JWT token for the authenticated user
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
    public function modifierUser(int $id,array $data){
        $user = $this->userRepository->findById($id);

        if(!$user){
            return null;
        }
        return $this->userRepository->update($id,$data);
    }
    public function deleteUser(int $id)
    {
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }
        
        if (auth()->id() !== $user->id) {
            return ['success' => false, 'message' => 'You can only delete your own account'];
        }
        
        if ($this->userRepository->delete($id)) {
            return ['success' => true, 'message' => 'User deleted successfully'];
        }
        
        return ['success' => false, 'message' => 'Failed to delete user'];
    }
    

}