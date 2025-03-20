<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:100',
            'password' => 'required|min:6'
        ]);

        $result = $this->authService->register($fields);

        return response()->json($result,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|max:100',
            'password' => 'required|min:6'
        ]);

        $result = $this->authService->login($fields);

        return response()->json([$result]);
    }

}
