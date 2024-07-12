<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function resetPassword(Request $request){
        try { 
            $credentials = $request->validate([
                'email' => ['required', 'string', 'exists:users,email'],
                'password' => ['required', 'string'],
                
            ]);
            $user = User::where('email', $credentials["email"])->first();
            if ($user) {
                $user->password = Hash::make($credentials["password"]);
                $user->save();
                $request->session()->put('reset');
                return response()->json(['status' => false, 'message' => '', 'result' => []], 200);
                // redirect()->route('client')->with('success', 'Mot de passe mis à jour avec succès. Veuillez vous connecter.');
            }
            return redirect()->route('resetPassword')->with('error', 'email invalide.');
        }catch(ValidationException $e) {
            return response()->json(['status' => false, 'message' => '', 'result' => []], 200);
        }
        return response()->json(['status' => false, 'message' => '', 'result' => []], 401); 
    }
}
