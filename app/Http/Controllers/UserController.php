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

    public function update(Request $request , $id){
        $data = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|max:100'
        ]);

        $user = $this->authService->modifierUser($id,$data);

        if($user){
            return response()->json(['message'=>'ok',$user]);
        }
    }
    public function deleteUser(int $id)
    {
        $result = $this->authService->deleteUser($id);
        
        if ($result['success']) {
            return response()->json(['message' => $result['message']], 200);
        } else {
            return response()->json(['message' => $result['message']], 400);
        }
    }
}
