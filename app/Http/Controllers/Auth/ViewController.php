<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function indexView(Request $request){
        if(Auth::check() && $request->session()->get('Collector')){
            $user = Auth::user();
        //     // $collecteId = app(CollecteController::class)->showId([$user->id]);
        //     // $user->clientId = $collecteId;
        //     // $entreprise = app(UserController::class)->showEntreprise([$collecteId]);
        //     // $user->pointCollecte = $entreprise;
            return view('admin/welcome_login_admin', compact('user'));
        } else if(Auth::check() && $request->session()->get('Waste')){
            return view('client/home_client', compact('user'));
        } else {
            return view('admin/home_admin');
        }
    }

}
