<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function indexView(Request $request){
        if(Auth::check() && $request->session()->get('admin')){
            $user = Auth::user();
        //     // $collecteId = app(CollecteController::class)->showId([$user->id]);
        //     // $user->clientId = $collecteId;
        //     // $entreprise = app(UserController::class)->showEntreprise([$collecteId]);
        //     // $user->pointCollecte = $entreprise;
            return view('admin/welcome_login_admin', compact('user'));
        } else if(Auth::check() && $request->session()->get('client')){
            $user = Auth::user();
            return view('client/welcome_login_client', compact('user'));
        } else if($request->server->get("REQUEST_URI") == "/admin"){
            return view('admin/home_admin');
        } else if($request->server->get("REQUEST_URI") == "/client" || $request->session()->exists('reset')){
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return view('client/home_client');
        } else {
            return view('client/reset_password_client');
        }
    }

}
