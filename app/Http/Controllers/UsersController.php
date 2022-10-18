<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class UsersController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'username' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed|min:8',
        ]);

        $attributes = array(
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        );
        
        if($user = User::create($attributes)){
            $error = false;
            $message = "Account Created Successfully!";
        }else{
            $error = true;
            $message = "Could not create account";
        }

        $array = array(
            'error' => $error,
            'message' => $message,
            'user' => $user,
        );

        return json_encode($array);

    }

    public function authenticate(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->get();

        if($user->isEmpty()){
            $error = true;
            $message = "Email Not Found!";
            $user = array();
        }else{

            if(!Hash::check($request->password, $user->first()->password)){
                $error = true;
                $message = "Password does not match!";
                $user = array();
            }else{
                $error = false;
                $message = "Logged in successfully!";
            }

        }
        
        $user = array(
            'id' => $user->first()->id,
            'username' => $user->first()->username,
            'email' => $user->first()->email,
        );

        $array = array(
            'error' => $error,
            'message' => $message,
            'user' => $user,
        );

        return json_encode($array);

    }

    public function index(){
        return UserResource::collection(User::all());
    }

}
