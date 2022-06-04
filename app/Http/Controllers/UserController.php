<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
class UserController extends BaseController
{


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function register(Request $request){
       $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
       
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   

        return $this->sendResponse($success, 201);        
    }

    
	public function login(Request $request)
	{
	    $data = [
	        'email' => $request->email,
	        'password' => $request->password

	    ];
	    
	   $user = User::where('email',$request->email)->first();

		if(!$user){
		    return response()->json(['error' => 'user not found create new acoount !'], 401);
		}

		if (!Hash::check($request->password,$user->password)) {
		    return response()->json(['error' => 'Your password does not match ! '], 404);
		}
        
         else {
		    auth()->login($user);
            $token = $user->createToken($this->generateRandomString())->accessToken;
             $response = [
                    'user' => $user,
                    'token' => $token,
                ];
		    return response($response, 200);
		}
		return $token ;
	}

}
