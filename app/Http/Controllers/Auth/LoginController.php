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
                $clientRole = Role::find(1)->client()->where('user_id', $user->id)
                ->first();  
                $adminRole = Role::find(1)->administrateur()->where('user_id', $user->id)
                ->first();
                $permissions = app('Permission');
                if($clientRole){
                    $user = $clientRole;
                    $ids = $clientRole->get('id');
                    $id = $ids[0]['id'];
                    $role = $clientRole->role->name_role;
                    $permission = $permissions->assignPermissionToRole($role);  
                    $request->session()->put('Client', [
                        'token' => $user->remember_token,
                        'permissions' => $permission,
                        $role => $id,
                    ]);
                } else {
                    $user = $adminRole;
                    $ids = $adminRole->get('id');
                    $id = $ids[0]['id'];
                    $role = $adminRole->role->name_role;
                    $permission = $permissions->assignPermissionToRole($role);  
                    $request->session()->put('Collector', [
                        'token' => $user->remember_token,
                        'permissions' => $permission,
                        $role => $id,
                    ]);
                }
                // dd($request->session()->get('Collector'));
                return response()->json(['result' => $user, 200]);     
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
