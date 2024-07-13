<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Role;
use App\Models\Entreprise;
use App\Models\CollectePoint;

class CollectePointController extends Controller
{
    public function storeCollectePoint(Request $request){

    }

    public function updateCollectePoint(Request $request, string $id){

    }
    
    public function destroyCollectePoint(string $id){

    }

    public function indexCollectePoint(){

    }

    public function findCollectePointById(Request $request){
        if (Auth::check()) {
            $collectePoint = CollectePoint::where('id', $request->id)->get();
            $userId = Auth::user()->id;
            $client = Client::where('user_id', $userId)->first();
            $collectePoint[0]->user = $client;
            $entreprise = Entreprise::where('id', $collectePoint[0]->entreprise_id)->first();
            $collectePoint[0]->entreprise = $entreprise;
            return response()->json(['result' => $collectePoint]);
        } else {
            return response()->json(['result' => 'Veuillez vous identifier']);
        }
    }

    public function findCollectePointByUser($id){
        $user = Role::find(2)->client()->where('user_id', $id)->first();
        $collectePoint = Client::find($user->id)->collectePoint;
        foreach($collectePoint as $cp){
            $cp->entreprise = Entreprise::find($cp->entreprise_id);
        };
        return $collectePoint;
    }
}
