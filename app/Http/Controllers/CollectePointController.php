<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Role;
use App\Models\Entreprise;

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

    public function findCollectePointByUser($id){
        $user = Role::find(2)->client()->where('user_id', $id)->first();
        $collectePoint = Client::find($user->id)->collectePoint;
        foreach($collectePoint as $cp){
            $cp->entreprise = Entreprise::find($cp->entreprise_id);
        };
        return $collectePoint;
    }
}
