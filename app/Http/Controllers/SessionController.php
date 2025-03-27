<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SessionRepository;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;

class SessionController extends Controller
{
    private $sessionRepository;
    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }
    // Associate a film to a session
    public function AddFilmTs(Request $request){
        $fields = $request->validate([
            'filmId' => 'required|exists:films,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => 'required',
            'salleId' => 'required|exists:salles,id'
        ]);

        $result = $this->sessionRepository->create($fields);

        if($result){
            return response()->json(['message'=>'ok','result'=>$result]);
        }
        else{
            return response()->json(['message'=>'error','result'=>$result]);
        }
    }
    public function filterByType(Request $request,$type){
        $result = $this->sessionRepository->findBytype($type);
        if($result){
            return response()->json(['message'=>'ok','result'=>$result]);
        }
        else{
            return response()->json(['messag'=>'error']);
        }
        }
        public function showAll(){
            $result = $this->sessionRepository->showdata();
            if($result){
                return response()->json(['message'=>'ok','result',$result]);
            }
            else{
                return response()->json(['message'=>'error']);
            }
        }
        public function countAllSession(){
            $result = $this->sessionRepository->countTotalSession();
            return response()->json(['message'=>'ok','result'=>$result]);
        }
}
