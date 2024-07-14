<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Role;
use App\Models\Entreprise;
use App\Models\CollectePoint;
use App\Models\Dechet;
use App\Http\Controllers\PassageController;
use App\Http\Controllers\DechetController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollectePointController extends Controller
{
    public function storeCollectePoint(Request $request){
        if (Auth::check()) {
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $idCollecte = DB::table('collectes')->insertGetId([
                'date_collecte' => $date,
                'collecte_point_id' => $request->id
            ]);
            $cp = collectePoint::find($request->id);
            $departement = $cp->departement_collecte_point;
            $passageController = new PassageController();
            $passageController->storePassage($request, $departement, $idCollecte);
            $dechet =  Dechet::where('name_dechet', $request->dechet)->first();
            DB::insert("insert into collectes_dechets_lines (collecte_id, dechet_id, poid_collecte_dechet_line)
            values (?, ?, ?)", [$idCollecte, $dechet->id, $request->poids]);
            // $dechetController = new DechetController();
            // $dechetController->updateDechet($request);
            return response()->json(['result' => 'Collecte créée avec succés']);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la colllecte']);
        }

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
