<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Role;

class LoginController extends Controller
{
    public function login(Request $request){
        try { 
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();  
                $user = User::where('email', $request->email)->first();            
                $userOrAdmin = '';
                if(substr($request->server->get("HTTP_REFERER"), -6, 6) == "client"){
                    $userOrAdmin = Role::find(2)->client()->where('user_id', $user->id)->first(); } 
                if(substr($request->server->get("HTTP_REFERER"), -5, 5) == "admin"){
                    $userOrAdmin = Role::find(1)->administrateur()->where('user_id', $user->id)
                    ->first(); } 
                $permissions = app('Permission');
                $user = $userOrAdmin;
                $ids = $userOrAdmin->get('id');
                $id = $ids[0]['id'];
                $role = $userOrAdmin->role->name_role;
                $permission = $permissions->assignPermissionToRole($role);  
                $request->session()->put($role, [
                    'token' => $user->remember_token,
                    'permissions' => $permission,
                    $role => $id,
                ]);
                return response()->json(['user' => $user, 200]);     
            }        
        }catch(ValidationException $e) {
            return response()->json(['status' => false, 'message' => '', 'result' => []], 200);
        }
        return response()->json(['status' => false, 'message' => '', 'result' => []], 401);
    }

    public function logout(Request $request) {
        
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['status' => false, 'message' => '', 'result' => []], 200);
    }
}
