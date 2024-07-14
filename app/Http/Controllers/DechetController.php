<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dechet;

class DechetController extends Controller
{
    public function storeDechet(Request $request){

    }

    public function updateDechet(Request $request){

    }
    
    public function destroyDechet(string $id){

    }

    public function indexDechet(){
        if (Auth::check()) {
            $dechet = Dechet::all();

            return response()->json(['result' => $dechet]);
        } else {
            return response()->json(['result' => 'Veuillez vous identifier']);
        }
    }

    public function findDechetById(){

    }
}
