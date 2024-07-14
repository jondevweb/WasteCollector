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
                    $dechetController = new DechetController();
                    $dechetController->updateDechet($request);
                    return response()->json(['result' => 'Collecte créée avec succés']);
                }
                return response()->json(['result' => 'Vous ne pouvez pas créer de collecte']);
            }
            return response()->json(['result' => 'Problème ave le point de collecte']);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la colllecte']);
        }

    }
    
    public function destroyCollecte(string $id){

    }

    public function indexCollecte(){
        if (Auth::check()) {
            $collecteArray = [];
            $oneCollecteArray = '';
            $collectes = Collecte::all();
            $collecteDechetsLines = DB::table('collectes_dechets_lines')->get();
            foreach($collectes as $collecte){
                $collectePoint = CollectePoint::find($collecte->collecte_point_id);
                foreach($collecteDechetsLines as $cdl){
                    if($collecte->id == $cdl->collecte_id){
                       $dechets = Dechet::find($cdl->dechet_id);
                        $oneCollecteArray = array(
                            array("date"=> $collecte->date_collecte,"dechet" => $dechets->name_dechet,"poid" => $cdl->poid_collecte_dechet_line,"adress" => $collectePoint->adresse_collecte_point)
                        );
                        // dd($oneCollecteArray[0]);
                    //    array_push($oneCollecteArray, $collecte->date_collecte); 
                    //    array_push($oneCollecteArray, $dechets->name_dechet);   
                    //    array_push($oneCollecteArray, $cdl->poid_collecte_dechet_line);   
                    //    array_push($oneCollecteArray, $collectePoint->adresse_collecte_point);   
                       array_push($collecteArray, $oneCollecteArray[0]);
                       $oneCollecteArray = '';         
                    };
                };  
            }
            return response()->json(['result' => $collecteArray]);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la colllecte']);
        }

    }

    public function findCollecteById(){

    }
}
