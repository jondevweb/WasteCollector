<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Passage;
use App\Models\Transporteur;
use Carbon\Carbon;

class PassageController extends Controller
{
    public function storePassage(Array $request, int $departement, int $idCollecte){
        if (Auth::check()) {                       
            $date = Carbon::createFromFormat('d/m/Y', $request["date"])->format('Y-m-d');
            $transporteur = Transporteur::where('immatriculation_transporteur',$departement)->get('id');
            Passage::create([
                'date_debut_passage' => $date,
                'collecte_id' => $idCollecte,
                'transporteur_id' => $transporteur[0]->id,
                'date_fin_passage' => '2024-01-01',
                'validation_transporteur_passage' => false,
                'commentaire_transporteur_passage' => '',
                'photo_transporteur_passage' => ''
            ]);
        } else {
            return response()->json(['result' => 'Une erreur est survenue pendant la création de la colllecte']);
        }
    }
    
    public function updatePassage(Request $request, string $id){

    }

    public function findDepartementTransporteur(){

    }
    
    public function printDayPassage(){

    }

    public function destroyCommentaire(){

    }
}
