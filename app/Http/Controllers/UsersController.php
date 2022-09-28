<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(Request $request){
        
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed|min:8',
        ]);
        
        return (User::create($validated)->toJson());
    }
}
