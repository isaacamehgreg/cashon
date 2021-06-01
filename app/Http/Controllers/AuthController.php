<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\GamesPicked;
use App\Models\Multiplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function login(Request $request){
    
        
        //if cashier id and password match
        $cashier_id = $request->input('cashier_id');
        $password = $request->input('password');
        $terminal_id = DB::table('terminal_creds')->where('cashier_id',$cashier_id)->where('password',$password)->value('terminal_id');
        if( $terminal_id == null || $terminal_id == '' ){
        return response()->json(['message'=>'cashier does not exist']);
        }
        $_email = DB::table('users')->where('id',$terminal_id)->value('email');
        $_password = DB::table('users')->where('id',$terminal_id)->value('password');
        $user = User::where('email',$_email)->first();

        $token = $user->createToken($terminal_id)->plainTextToken;
        //login terminal in

        return response()->json([
            'user'=>$user,
            'token'=>$token,
        ]);
     

    }

    // public function logout(){
        
    //    auth()->user()->tokens()->delete;

    // }


}
