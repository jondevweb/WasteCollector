<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function updateAdmin(Request $request, string $id){

    }

    public function updateClient(Request $request, string $id){

    }

    public function Notification()
    {

        $users = User::all();

        foreach ($users as $user) {
            dd($user);
        $notifications = $user;

        }
    
        return view('welcome', compact('notifications'));
    }
}
