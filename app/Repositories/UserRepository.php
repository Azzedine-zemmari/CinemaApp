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
        return User::findOrFail($id);
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
public function delete(int $id)
{
    $user = $this->findById($id);
    
    if (!$user) {
        return false; // User not found
    }
    
    // Only allow deletion if the logged-in user is the same as the user to be deleted
    if (auth()->id() === $user->id) { 
        try {
            $user->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    return false; // Not authorized to delete
}
    
}