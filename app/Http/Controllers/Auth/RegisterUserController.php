<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterUserController extends Controller
{
    public function storeClient(Request $request){

    }
    
    public function destroyClient(string $id){

    }

    public function storeAdmin(Request $request){

        Illuminate\Support\Facades\DB::insert("insert into users (first_name,name,phone,cellphone,email,email_verified_at,password,remember_token,created_at,updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", ['John', 'Admin', '0123456789', '0654123987', 'jadmin@wc.info', NULL, 'toto', NULL, NULL, NULL]);

        Illuminate\Support\Facades\DB::insert("insert into administrateurs (signature_admin, user_id, role_id, entreprise_id, email_admin, telephone_admin, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?)", ['John Admin', '1', '1', '1', 'jadmin@wc.info', '0654123987', NULL, NULL]);
    }
    
    public function destroyAdmin(string $id){

    }
}
