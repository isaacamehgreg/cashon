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

class AuthController extends Controller
{
    
    public function login(Request $request){
    

        $fields= $request->validate([
            'cashier_id' =>'required|string|unique',
            'password' =>'required|string'
        ]);


    }

    public function logout(){
        

    }


}
