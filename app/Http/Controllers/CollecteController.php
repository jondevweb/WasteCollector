<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Role;
use App\Models\Entreprise;
use App\Models\CollectePoint;
use App\Models\Collecte;
use App\Models\Dechet;
use App\Http\Controllers\PassageController;
use App\Http\Controllers\DechetController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollecteController extends Controller
{
    public function storeCollecte(Request $request){
        if (Auth::check()) {
            $permission = [];
            $permissions = $request->session()->get("client")['permissions'];
            foreach($permissions as $permission){
                if($permission = 'create_collecte_client'){
                    for($i = 0; $i < 3; $i++){
                        if($request[$i] != null){
                            $date = Carbon::createFromFormat('d/m/Y', $request[$i][0]["date"])->format('Y-m-d');
                            $idCollecte = DB::table('collectes')->insertGetId([
                                'date_collecte' => $date,
                                'collecte_point_id' => $request[$i][0]["id"]
                            ]);
                            $cp = collectePoint::find($request[$i][0]["id"]);
                            $departement = $cp->departement_collecte_point;
                            $passageController = new PassageController();
                            $passageController->storePassage($request[$i][0], $departement, $idCollecte);
                            $dechet =  Dechet::where('name_dechet', $request[$i][0]["dechet"])->first();
                            DB::insert("insert into collectes_dechets_lines (collecte_id, dechet_id, poid_collecte_dechet_line)
                            values (?, ?, ?)", [$idCollecte, $dechet->id, $request[$i][0]["poids"]]);
                        }
                    }
                    $dechetController = new DechetController();
                    $dechetController->updateDechet($request);  
                    return response()->json(['result' => 'Collecte créée avec succés']);
                }
                return response()->json(['result' => 'Vous ne pouvez pas créer de collecte']);
            }
            return response()->json(['result' => 'Problème ave le point de collecte']);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la collecte']);
        }

    }
    
    public function destroyCollecte(string $id){

    }

    public function indexCollecte(Request $request){
        if (Auth::check()) {
            $collecteArray = [];
            $oneCollecteArray = '';
            $collecteWithPdcId = Collecte::where('collecte_point_id', '=', $request->id)->orderBy('date_collecte', 'desc')->get();
            foreach($collecteWithPdcId as $collecte){
                $collecteDechetsLines = DB::table('collectes_dechets_lines') ->where('collecte_id', '=', $collecte->id)->get();
                $dechet = Dechet::where('id','=', $collecteDechetsLines[0]->dechet_id)->get("name_dechet");
                $oneCollecteArray = array(
                    array("date"=> $collecte->date_collecte,
                          "dechet" => $dechet[0]->name_dechet,
                          "poid" => $collecteDechetsLines[0]->poid_collecte_dechet_line)
                );
                array_push($collecteArray, $oneCollecteArray[0]);
                $oneCollecteArray = ''; 
            } 
            return response()->json(['result' => $collecteArray]);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la collecte']);
        }
    }

    public function findCollecteById(){

    }
}
