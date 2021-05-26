<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/least', function () {

        $most =   DB::table('games_played')
               ->select('number')
               ->groupBy('number')
               ->orderByRaw('COUNT(*) DESC')
               ->limit(5)
               ->get();
   
       $least =   DB::table('games_played')
                   ->select('number')
                   ->groupBy('number')
                   ->orderByRaw('COUNT(*) ASC')
                   ->limit(5)
                   ->get();
   
       

       return response()->json($least,200);
       

});