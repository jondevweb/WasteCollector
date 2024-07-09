<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function storeRole(Request $request){
        Illuminate\Support\Facades\DB::insert("insert into roles (name_role, created_at, updated_at) values (?, ?, ?)", ['admin', NULL, NULL]);
    }
    
    public function destroyRole(string $id){

    }
}
