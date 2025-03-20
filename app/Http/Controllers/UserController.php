<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositorieInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositorieInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showUsers(){
        $users = $this->userRepository->all();
        return $users;
    }
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:100',
            'password' => 'required|min:6'
        ]);

        $result = $this->userRepository->register($fields);

        return response()->json([
            'message'=>'user registred successfully',
            'user' => $result['user'],
            'token'=>$result['token']
        ],201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|max:100',
            'password' => 'required|min:6'
        ]);

        $result = $this->userRepository->login($fields);

        return response()->json([$result]);
    }
    
}
