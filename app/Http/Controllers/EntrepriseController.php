<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    public function storeEntreprise(Request $request){
        Illuminate\Support\Facades\DB::insert("insert into entreprises (raison_sociale_entreprise, siret_entreprise, adresse_administrative_entreprise, number_employee_entreprise, created_at, updated_at) values (?, ?, ?, ?, ?, ?)", ['Waste Collector', '12345678910111', '1 Rue de Paname, 75001 Paris', '15', NULL, NULL]);
    }

    public function updateEntreprise(Request $request, string $id){

    }
    
    public function destroyEntreprise(string $id){

    }

    public function findEntrepriseById(Request $request){
        if (Auth::check()) {
            dd($request);
            $entreprise = Entreprise::where('id', $request->id)->get();
            return response()->json(['result' => $entreprise]);
        } else {
            return response()->json(['result' => 'Veuillez vous identifier']);
        }
    }
}
