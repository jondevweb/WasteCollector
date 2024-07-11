<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PermissionService;

class RoleController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function storeRole(Request $request){
        Illuminate\Support\Facades\DB::insert("insert into roles (name_role, created_at, updated_at) values (?, ?, ?)", ['admin', NULL, NULL]);
    }

    public function getRole(Request $request, $roleName)
    {
        $role = $this->permissionService->getRoleByName($roleName);

        if ($role) {
            return response()->json(['role' => $role]);
        } else {
            return response()->json(['error' => 'Role not found'], 404);
        }
    }
    
    public function destroyRole(string $id){

    }
}
