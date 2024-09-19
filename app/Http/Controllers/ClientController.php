<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    public function findClient(int $id){
        return $user = User::find($id);
    }
}
