<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)){
            return response(Auth::user(), 200);
        }else{
             return response('Ошибка аутентификации', 200);
//            dd(request()->all());
        }

//        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
//            $authUser = Auth::user();
//            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
//            $success['name'] =  $authUser->name;
//
//            return $this->sendResponse($success, 'User signed in');
//        }
//        else{
//            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
//        }
    }


    public function logout(){
        Auth::logout();
        return response(null, 200);
    }

    public function user(){
        return response(Auth::user(), 200);
    }
}
