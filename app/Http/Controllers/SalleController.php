<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\SalleRepositorieInterface;

class SalleController extends Controller
{
    private $sallerepository;
    public function __construct(SalleRepositorieInterface $sallerepository)
    {
        $this->sallerepository = $sallerepository;
    }
    public function configureSalle(Request $request){
        $data = $request->validate([
            'nom' => 'required',
            'type' => 'required'
        ]);
       $result = $this->sallerepository->create($data);
       if($result){
        return response()->json(['message'=>'ok','result'=>$result]);
       }
       else{
        return response()->json(['message'=>'error']);
       }
    }
}
