<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TerminalController;
use App\Models\Bet;
use App\Models\GamesPicked;
use App\Models\Multiplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;



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

//public routes 
Route::post('/login',[AuthController::class, 'login']);


//protected route
Route::group(['middleware'=>['auth:sanctum']] , function () {
    Route::post('/_logout',[AuthController::class, '_logout']);
    Route::post('/place_bet',[TerminalController::class, 'place_bet']);

   



//     Route::get('/least', function () {

//         $most =   DB::table('games_played')
//                ->select('number')
//                ->groupBy('number')
//                ->orderByRaw('COUNT(*) DESC')
//                ->limit(5)
//                ->get();
   
//        $least =   DB::table('games_played')
//                    ->select('number')
//                    ->groupBy('number')
//                    ->orderByRaw('COUNT(*) ASC')
//                    ->limit(5)
//                    ->get();
   
//        return response()->json($least,200);
       

//    });
//    Route::get('try', function () {
//        return 'try';
//    });
});




// Route::get('bet',function(){
//     return view('terminal.terminal');
// });


// Route::post('bet',function(Request $request){
//     return view('terminal.terminal');
// });

// //placeholder
// Route::post('bet/{terminal_id}', [TerminalController::class, 'bet']);


